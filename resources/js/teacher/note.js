/*!
 *
 * @version 1.0.0
 */

import helper from './../helper';

const objNote = {};

$(function () {

    /**
     * Realiza la creación del usuario
     */
    objNote.save = function () {
        const button = $(this);
        helper.buttonLoading(button);
        const form = $('#frmGeneral');
        axios.post(form.attr('action'), form.serialize()
        ).then(({data}) => {
            $('#messages').before(helper.alertDisplay('success', data.message));
            setTimeout(function() {
                window.location = location.href;
            }, 1000);
        }).catch(({data}) => {
            const errors = Object.entries(data.errors);
            helper.errorDisplay(errors);
        }).finally(() => {
            helper.buttonCloseLoading(button);
        });
    };

    objNote.calculateNT = function() {
        const row = $(this).parents('tr');
        const position = row.data('position');
        let work1 = parseFloat(document.getElementById('work_note1[' + position + ']').value);
        work1 = (isNaN(work1)) ? 0 : work1;
        let work2 = parseFloat(document.getElementById('work_note2[' + position + ']').value);
        work2 = (isNaN(work2)) ? 0 : work2;
        let work3 = parseFloat(document.getElementById('work_note3[' + position + ']').value);
        work3 = (isNaN(work3)) ? 0 : work3;
        document.getElementById('prom_nt[' + position + ']').value = ((work1 + work2 + work3) / 3).toFixed(2);
        objNote.calculateProm(position);
    };

    objNote.calculateTI = function() {
        const row = $(this).parents('tr');
        const position = row.data('position');
        let value = parseFloat(document.getElementById('work_investigation[' + position + ']').value);
        value = (isNaN(value)) ? 0 : value;
        document.getElementById('prom_ti[' + position + ']').value = value.toFixed(2);
        objNote.calculateProm(position);
    };

    objNote.calculateEF = function() {
        const row = $(this).parents('tr');
        const position = row.data('position');
        let value = parseFloat(document.getElementById('final_exam[' + position + ']').value);
        value = (isNaN(value)) ? 0 : value;
        document.getElementById('prom_ef[' + position + ']').value = value.toFixed(2);
        objNote.calculateProm(position);
    };

    objNote.calculateProm = function(position) {
        let nt = parseFloat(document.getElementById('prom_nt[' + position + ']').value);
        nt = (isNaN(nt)) ? 0 : nt;
        let ti = parseFloat(document.getElementById('prom_ti[' + position + ']').value);
        ti = (isNaN(ti)) ? 0 : ti;
        let ef = parseFloat(document.getElementById('prom_ef[' + position + ']').value);
        ef = (isNaN(ef)) ? 0 : ef;
        document.getElementById('prom_final[' + position + ']').value = ((nt * 0.2) + (ti * 0.3) + (ef * 0.5)).toFixed(2)
    };

});

$(document).ready(function () {

    $('#btnSaveNote').click(objNote.save);

    $(document).on('keyup', '.calculate-nt', objNote.calculateNT);

    $(document).on('keyup', '.calculate-ti', objNote.calculateTI);

    $(document).on('keyup', '.calculate-ef', objNote.calculateEF);

});
