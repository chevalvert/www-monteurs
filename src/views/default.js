import view from 'abstractions/barba-view'
import mobile from 'utils/is-mobile'
import lazy from 'controllers/lazy'
import linkFader from 'controllers/link-fader'
import toc from 'components/toc'
import sidebar from 'components/sidebar'
import figure from 'components/article-figure'
// import drawer from 'components/mobile-drawer'

export default view('default|publication|member-new|form.add-member-new', {
  onEnterCompleted: refs => {
    refs.lfader = linkFader()
    refs.lazy = lazy()
    refs.toc = toc()
    refs.figure = figure()

    // TODO: refactor mobile-drawer UX
    // if (mobile) refs.drawer = drawer()
    if (!mobile) refs.sidebar = sidebar()
  }
})
