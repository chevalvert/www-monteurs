import 'nodelist-foreach'
import mobile from 'utils/is-mobile'

// NOTE: this is the JS equivalent of Kirby $page->isOpen()
const isOpen = (href, uri) => ~href.indexOf(uri)

// NOTE: this is the JS equivalent of Kirby $page->isActive()
const isActive = (href, uri) => !window.location.href.split(uri).pop()

const baseSelector = mobile() ? '.menu-mobile' : '.menu'
const menu = document.querySelector(baseSelector)
const items = menu.querySelectorAll(`${baseSelector}__nav-item`)
const links = menu.querySelectorAll(`${baseSelector}__nav-item-link`)
const toggler = menu.querySelector('input[type=checkbox]')

links.forEach(link => link.addEventListener('click', () => {
  link.blur()

  if (!toggler) return
  toggler.checked = false
  document.body.style.overflow = 'auto'
}))

toggler && toggler.addEventListener('change', () => {
  document.body.style.overflow = toggler.checked ? 'hidden' : 'auto'
})

export default {
  update: () => {
    const uri = document.body.getAttribute('data-uri')
    items.forEach(item => {
      const href = item.querySelector('a').getAttribute('href')
      item.classList.remove('is-active', 'is-open')

      if (isOpen(href, uri)) {
        const state = isActive(href, uri) ? 'is-active' : 'is-open'
        item.classList.add(state)
      }
    })
  }
}
