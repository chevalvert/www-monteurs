import view from 'abstractions/barba-view'

import lazy from 'controllers/lazy'
import sidebar from 'components/sidebar'
import linkFader from 'controllers/link-fader'

export default view('list.articles|list.publications|list.member-news', {
  onEnterCompleted: refs => {
    refs.lfader = linkFader()
    refs.lazy = lazy()
    refs.sidebar = sidebar()
  }
})
