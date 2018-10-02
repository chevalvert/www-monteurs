import mobile from 'utils/is-mobile'
import observeScroll from 'utils/observe-scroll-breakpoint'

export default ({
  elements,
  selector = '.is-sticky',
  className = 'is-sticked',
  offy = 0
} = {}) => {
  if (mobile) return

  return observeScroll({
    elements,
    selector,
    offy,
    onBreakpointEnter: element => element.classList.add(className),
    onBreakpointLeave: element => element.classList.remove(className)
  })
}
