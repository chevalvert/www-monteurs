import 'nodelist-foreach'

export default ({
  elements = document.querySelectorAll('.article__content, .menu__nav, footer[role="main"]')
} = {}) => {
  if (!elements) return

  let links = []

  elements.forEach(container => {
    links = links.concat(Array.from(container.querySelectorAll('a:not(.unstyled-link)'), link => {
      link.container = container
      link.addEventListener('mouseenter', addClass, false)
      link.addEventListener('mouseleave', removeClass, false)
      return link
    }))
  })

  return {
    destroy: () => {
      links.forEach(link => {
        link.removeEventListener('mouseenter', addClass)
        link.removeEventListener('mouseleave', removeClass)
      })
      links = undefined
    }
  }

  function addClass () { this.container.classList.add('has-hovered-link') }
  function removeClass () { this.container.classList.remove('has-hovered-link') }
}
