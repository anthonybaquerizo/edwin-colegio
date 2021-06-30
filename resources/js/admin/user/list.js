/*!
 *
 * @version 1.0.0
 */

import helper from "../../helper";

const objUserList = {};

$(function() {

    /**
     * Elimina un usuario
     */
    objUserList.removeItem = function() {
        const id = $(this).data('id');
        axios.delete('panel/admin/user/delete/' + id,
        ).then(({data}) => {
            location.href = data.refresh;
        }).catch(({data}) => {
            const errors = Object.entries(data.errors);
            helper.errorDisplay(errors);
        });
    };

});

$(document).ready(function() {

    $('.option-delete').click(objUserList.removeItem);

});
