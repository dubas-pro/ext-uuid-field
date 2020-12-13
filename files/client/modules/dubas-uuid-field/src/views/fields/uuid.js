define('dubas-uuid-field:views/fields/uuid', 'views/fields/base', function (Dep) {

    return Dep.extend({

        type: 'uuid',

        validations: [],

        inlineEditDisabled: true,

        readOnly: true,

        fetch: function () {
            return {};
        },
    });
});