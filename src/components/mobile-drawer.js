import 'nodelist-foreach'
import omniscroll from 'omniscroll'
// import observeScroll from 'utils/observe-scroll-breakpoint'

export default ({
  container = document.querySelector('main'),
  elements = document.querySelectorAll('.main__header, .main__sidebar'),
  minOpenDistance = 50,
  minCloseDistance = 1
} = {}) => {
  const drawer = document.createElement('div')
  drawer.classList.add('mobile-drawer')
  container.appendChild(drawer)

  elements.forEach(element => drawer.appendChild(element.cloneNode(true)))
  drawer.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', close, false)
  })

  // TODO: handle drawer hiding when original container is visible
  // let scrollObserver = observeScroll({
  //   elements: [elements[0]],
  //   offy: -drawer.offsetHeight,
  //   onBreakpointEnter: () => {
  //     drawer.style.display = 'block'
  //     console.log('show')
  //   },
  //   onBreakpointLeave: () => {
  //     drawer.style.display = 'none'
  //     console.log('hide')
  //   }
  // })

  // TODO: either destroy omniscroll or make it a singleton
  omniscroll.init({ preventDefault: false }).bind(document).onDelta(({ delta }) => {
    const down = delta < 0
    const distance = Math.abs(delta)
    if (down && distance > minOpenDistance) open()
    else if (!down && distance > minCloseDistance) close()
  })

  return {
    destroy: () => {
      console.log(drawer)
      drawer.remove()
      console.log(drawer)
      // scrollObserver.destroy()
      // scrollObserver = undefined
    }
  }

  function open () {
    drawer.classList.add('is-open')
  }

  function close () {
    drawer.classList.remove('is-open')
  }
}
