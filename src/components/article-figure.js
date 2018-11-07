import 'nodelist-foreach'

import mediumZoom from 'medium-zoom'

export default ({
  selector = '.article-figure',
  linkSelector = '.article-figure__link',
  fullPreviewSelector = 'img',
  activeClass = 'is-open',
  // SEE: https://github.com/francoischalifour/medium-zoom#readme
  zoomOptions = {
    background: 'rgba(47, 49, 47, 0.9)',
    margin: 40
  }
} = {}) => {
  const figures = document.querySelectorAll(selector)
  if (!figures || !figures.length) return

  figures.forEach(figure => {
    const link = figure.querySelector(linkSelector)
    const fulls = figure.querySelectorAll(fullPreviewSelector)
    const full = fulls[fulls.length - 1]

    if (!link || !full) return

    figure.zoom = mediumZoom(full, zoomOptions)
    figure.zoom.on('open', () => full.parentNode.classList.add(activeClass))
    figure.zoom.on('closed', () => full.parentNode.classList.remove(activeClass))

    link.addEventListener('click', e => {
      e.preventDefault()
      figure.zoom.open()
    }, false)
  })

  return {
    destroy: undefined
  }
}
