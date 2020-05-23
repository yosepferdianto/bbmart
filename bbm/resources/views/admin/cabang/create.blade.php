$('#user_id').select2({
    ajax: {
        url: "{{ route('admin.settings.search-pic') }}"
        , dataType: 'json'
        , delay: 250
        , data: function(params) {
            return {
                q: params.term, // search term
                page: params.page
            };
        }
        , processResults: function(data) {
            return {
                results: $.map(data, function(item) {
                    return {
                        text: item.name
                        , id: item.id
                    }
                })
            };
        }
        , cache: true
    }
    , placeholder: "Pilih PIC"
, });