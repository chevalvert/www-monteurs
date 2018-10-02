import bowser from 'bowser'
import observeScroll from 'utils/observe-scroll-breakpoint'
import setHashSilently from 'utils/set-hash-silently'
import rafThrottle from 'utils/raf-throttle'
import scroll from 'scroll-into-view-if-needed'

export default ({
  linkSelector = '.toc-link',
  anchorSelector = '.toc-anchor',
  className = 'is-active',
  offy = 0,
  // SEE: https://scroll-into-view-if-needed.netlify.com/
  scrollIntoView = {
    behavior: 'smooth',
    block: 'start',
    scrollMode: 'always'
  }
} = {}) => {
  if (bowser.mobile) return

  const anchors = Array.from(document.querySelectorAll(anchorSelector), anchor => {
    const hash = anchor.id
    const link = document.querySelector(linkSelector + `[href='#${hash}']`)
    if (!link) return

    link.addEventListener('click', e => {
      e.preventDefault()
      setHashSilently(hash)
      scroll(anchor, scrollIntoView)
    })

    anchor.link = link
    return anchor
  }).filter(Boolean)

  if (!anchors || !anchors.length) return

  return observeScroll({
    elements: anchors,
    offy,
    throttler: rafThrottle,
    onBreakpointEnter: (element, elements) => {
      element.link.classList.add(className)
      // Make each element inactive until reaching the last element (which is the only active)
      ;[...elements].find(el => {
        if (el === element) return
        el.link.classList.remove(className)
      })
    },
    onBreakpointLeave: element => element.link.classList.remove(className)
  })
}
