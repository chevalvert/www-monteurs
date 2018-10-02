import view from 'abstractions/barba-view'
import lazy from 'controllers/lazy'
import bigtext from 'controllers/big-text'
import mobile from 'utils/is-mobile'

export default view('home', {
  onEnterCompleted: refs => {
    refs.lazy = lazy()
    if (mobile) return
    refs.bigtext = bigtext({
      selector: '.featured__hero-item:not(.has-cover) .featured__hero-item-title'
    })
  }
})
