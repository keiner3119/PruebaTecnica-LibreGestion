$(document).ready(function () {
    TestFunctionalities.Functions.LoadDataTable();
    TestFunctionalities.Functions.LoadUtilitiesOfDataTable();
    TestFunctionalities.Functions.ReadContacts();
    TestFunctionalities.Functions.ShowModalCreateContact();
    TestFunctionalities.Functions.HideModalCreateContact();
    TestFunctionalities.Functions.HideModalUpdateContact();
    TestFunctionalities.Functions.ClickButtonSaveNewContact();
    TestFunctionalities.Functions.ClickButtonSaveUpdateContact();
});

var TestFunctionalities = {
    Variables: {
        table: null
    },
    Functions: {
        ClickButtonSaveNewContact: () => {
            $('#addContactModal').on('submit', function (e) {
                e.preventDefault();
                var form = e.target;
                if (form.checkValidity() === false) {
                    e.stopPropagation();
                    $(form).addClass('was-validated');
                } else {
                    const contact = {
                        names: $('#names').val(),
                        phone: $('#phone').val(),
                        dateOfBirth: $('#dateOfBirth').val(),
                        address: $('#address').val(),
                        email: $('#email').val()
                    };

                    if (confirm(`¿Estás seguro de registrar el contacto?`)) {
                        TestFunctionalities.Functions.CreateContact(contact);
                    }
                }
            });
        },

        ClickButtonSaveUpdateContact: () => {
            $('#updateContactModal').on('submit', function (e) {
                e.preventDefault();
                var form = e.target;
                if (form.checkValidity() === false) {
                    e.stopPropagation();
                    $(form).addClass('was-validated');
                } else {
                    const contact = {
                        names: $('#namesUpdate').val(),
                        phone: $('#phoneUpdate').val(),
                        dateOfBirth: $('#dateOfBirthUpdate').val(),
                        address: $('#addressUpdate').val(),
                        email: $('#emailUpdate').val()
                    };

                    if (confirm(`¿Estás seguro de modificar el contacto?`)) {
                        TestFunctionalities.Functions.UpdateContact(contact);
                    }
                }
            });
        },

        ShowModalCreateContact: () => {
            $('#openModalCreate').on('click', function () {
                $('#createContactForm')[0].reset();
                $('#addContactModal').modal('show');
            });
        },

        ShowModalUpdateContact: () => {
            $('#updateContactModal').modal('show');
        },

        HideModalCreateContact: () => {
            $('#closeModalCreate').on('click', function () {
                $('#createContactForm')[0].reset();
                $('#addContactModal').modal('hide');
            });
        },

        HideModalUpdateContact: () => {
            $('#closeModalUpdate').on('click', function () {
                $('#updateContactForm')[0].reset();
                $('#updateContactModal').modal('hide');
            });
        },

        LoadDataTable: () => {
            TestFunctionalities.Variables.table = $('#contacts').DataTable({
                responsive: true,
                columns: [
                    { title: "Id", visible: false },
                    { title: "Nombres completos" },
                    { title: "Número celular" },
                    { title: "Fecha de nacimiento" },
                    { title: "Dirección" },
                    { title: "Email" }
                ]
            });
        },

        LoadUtilitiesOfDataTable: () => {
            $(document).on('click', function () {
                $('#context-menu').hide();
            });

            $('#contacts tbody').on('contextmenu', 'tr', function (e) {
                e.preventDefault();
                const rowData = TestFunctionalities.Variables.table.row(this).data();
                $('#context-menu')
                    .css({
                        top: e.pageY + 'px',
                        left: e.pageX + 'px'
                    })
                    .show()
                    .data('row-data', rowData);
            });

            $('#context-menu').on('click', 'a', function () {
                const action = $(this).data('action');
                const rowData = $('#context-menu').data('row-data');
                if (action === 'edit') {
                    $('#namesUpdate').val(rowData[1]);
                    $('#phoneUpdate').val(rowData[2]);
                    $('#dateOfBirthUpdate').val(rowData[3]);
                    $('#addressUpdate').val(rowData[4]);
                    $('#emailUpdate').val(rowData[5]);
                    TestFunctionalities.Functions.ShowModalUpdateContact();
                } else if (action === 'delete') {
                    if (confirm(`¿Estás seguro de eliminar a ${rowData[1]}?`)) {
                        TestFunctionalities.Functions.DeleteContact(rowData[0]);
                    }
                }
                $('#context-menu').hide();
            });
        },

        CreateContact: (contact) => {
            $.ajax({
                url: 'resources.php',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify(contact),
                contentType: 'application/json',
                success: function (data) {
                    if (data.response == "success") {
                        $('#addContactModal').modal('hide');
                        $('#createContactForm')[0].reset();
                        location.reload();
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error al enviar la solicitud:', error);
                }
            });
        },

        ReadContacts: () => {
            $.ajax({
                url: 'resources.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    TestFunctionalities.Variables.table.clear();
                    data.contacts.forEach(contact => {
                        TestFunctionalities.Variables.table.row.add([
                            contact.id,
                            contact.names,
                            contact.phone,
                            contact.date_of_birth,
                            contact.address,
                            contact.email
                        ]).draw(false);
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error al cargar datos:', error);
                }
            });
        },

        UpdateContact: (contact) => {
            console.log(contact);
            $.ajax({
                url: 'resources.php',
                type: 'PUT',
                dataType: 'json',
                data: JSON.stringify(contact),
                contentType: 'application/json',
                success: function (data) {
                    if (data.response == "success") {
                        $('#updateContactModal').modal('hide');
                        $('#updateContactForm')[0].reset();
                        location.reload();
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error al enviar la solicitud:', error);
                }
            });
        },

        DeleteContact: (id) => {
            $.ajax({
                url: 'resources.php?id=' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function (data) {
                    if (data.response == "success") {
                        location.reload();
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error al cargar datos:', error);
                }
            });
        }
    }
}