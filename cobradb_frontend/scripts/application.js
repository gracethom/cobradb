/*jslint evil: true*/
/*global jQuery, window, modal, console, Modal, confirm, alert */

jQuery(function ($) {
    'use strict';

    var counter = 0,
        setupConfirmation = function (confirmation, instance) {
            $('button', confirmation.context).on('click', function () {
                var shouldClose = $(this).text() === 'Yes';
                confirmation.close(true);
                if (shouldClose) {
                    instance.close(true);
                }
            });
        };

    $(document).on('click', '[data-modal]', function (e) {
        e.preventDefault();
        counter += 1;

        $(this).openModal({
            //title: 'Window #' + counter,
            htmlClass: 'modal-on',
            onLoad: function () {
                var instance = this;
                console.log('Log: Content loaded for ' + instance.title());
            }
        });
    });

});


$(document).on('click', '.submitForm', function () {
    $form = $(this).closest('.form');
    $action = $form.attr('data-action');
    console.log($action);
    $data = {};
    $form.find('input, textarea').each(function () {
        if ($(this).val() == ""){
            $data[this.name] = null;
        }else{
            $data[this.name] = $(this).val();
        }
    });
    
    console.log($data);
    // $data = {input1: "whatever is typed in input1", input2: "adsfasdf"};

    $.post($action, $data, function (response) {
           $form.html(response);
       
    });

});