function edit_poll(poll_id) {
    url = '?action=edit_poll&id='+poll_id
    window.location.assign('?action=edit_poll&id='+poll_id)
}

function take_poll(poll_id) {
    url = '?action=take_poll&id='+poll_id
    window.location.assign('?action=take_poll&id='+poll_id)
}
