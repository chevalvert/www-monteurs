import view from 'abstractions/barba-view'
import lazy from 'controllers/lazy'

export default view('search', {
  onEnterCompleted: refs => {
    refs.lazy = lazy()
  }
})
