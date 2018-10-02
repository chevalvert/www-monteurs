/* global history */

// Changing hash without hash jump
// SEE: http://lea.verou.me/2011/05/change-url-hash-without-page-jump/
export default hash => {
  if (history.pushState) history.pushState(null, null, '#' + hash)
  else window.location.hash = hash
}
