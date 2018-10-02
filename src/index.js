import menu from 'components/menu'
import barba from 'controllers/barba'

import 'views/home'
import 'views/default'
import 'views/list'
import 'views/search'

import defaultTransition from 'views/transitions/default'

barba({
  containerClass: 'js-wrapper',

  linkClicked: () => document.body.classList.add('is-loading'),
  newPageReady: () => menu.update(),
  transitionCompleted: () => document.body.classList.remove('is-loading'),

  transitionsMap: {
    default: defaultTransition
  }
})
