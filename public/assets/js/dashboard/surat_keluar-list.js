/**
 * App Invoice List (jquery)
 */

'use strict';

$(function () {
  // Variable declaration for table
  var dt_invoice_table = $('.invoice-list-table');

  // Invoice datatable
  if (dt_invoice_table.length) {
    var dt_invoice = dt_invoice_table.DataTable({
      ajax: assetsPath + 'json/dashboard/surat_keluar-list.json', // JSON file to add data
      columns: [
        // columns according to JSON
        {
          data: ''
        },
        {
          data: 'nomor'
        },
        {
          data: 'perihal'
        },
        {
          data: 'tujuan'
        },
        {
          data: 'tanggal'
        },
        {
          data: 'ringkasan'
        },
        {
          data: 'keterangan'
        },
        {
          data: ''
        }
      ],
      columnDefs: [{
          // For Responsive
          className: 'control',
          responsivePriority: 1,
          searchable: false,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          targets: 2,
          responsivePriority: 2,
        },
        {
          targets: 3,
          responsivePriority: 4,
        },
        {
          targets: 4,
          responsivePriority: 5,
        },
        {
          targets: 5,
          searchable: false,
        },
        {
          targets: 6,
          searchable: false,
        },
        {
          // Actions
          targets: -1,
          // title: 'Actions',
          searchable: false,
          orderable: false,
          responsivePriority: 3,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-flex align-items-center">' +
              '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body btn_preview" data-bs-placement="top" title="Preview"><i class="bx bx-show mx-1"></i></a>' +
              '<div class="dropdown">' +
              '<a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:;" class="dropdown-item btn_edit">Edit</a>' +
              '<a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>' +
              '</div>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      dom: '<"row ms-2 me-3"' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>>' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-2"f<"invoice_status mb-3 mb-md-0">>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Cari Data'
      },
      // Buttons with Dropdown
      buttons: [{
        text: '<i class="bx bx-plus me-md-2"></i><span class="d-md-inline-block d-none">Surat Keluar</span>',
        className: 'add-new btn btn-primary add-record',
        attr: {
          'data-bs-toggle': 'offcanvas',
          'data-bs-target': '#offcanvasAdd'
        }
      }],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['nomor'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ?
                '<tr data-dt-row="' +
                col.rowIndex +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>' :
                '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      },
    });
  }

  // On each datatable draw, initialize tooltip
  dt_invoice_table.on('draw.dt', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        boundary: document.body
      });
    });
  });

  // Delete Record
  $('.invoice-list-table tbody').on('click', '.delete-record', function () {
    dt_invoice.row($(this).parents('tr')).remove().draw();
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});

$(function () {
  // Bootstrap Datepicker-Format
  var bsDatepickerFormat = $('#bs-datepicker-format');
  if (bsDatepickerFormat.length) {
    bsDatepickerFormat.datepicker({
      todayHighlight: true,
      format: 'dd/mm/yyyy',
      orientation: isRtl ? 'auto right' : 'auto left'
    });
  }
  // --------------------------------------------------------------------
  // Autosize
  const textarea = document.querySelector('#keterangan');
  if (textarea) {
    autosize(textarea);
  }
  const textarea2 = document.querySelector('#perihal');
  if (textarea2) {
    autosize(textarea2);
  }
  const textarea3 = document.querySelector('#ringkasan');
  if (textarea3) {
    autosize(textarea3);
  }
  const textarea4 = document.querySelector('#catatan');
  if (textarea4) {
    autosize(textarea4);
  }
  // --------------------------------------------------------------------
  // String Matcher function
  var substringMatcher = function (strs) {
    return function findMatches(q, cb) {
      var matches, substrRegex;
      matches = [];
      substrRegex = new RegExp(q, 'i');
      $.each(strs, function (i, str) {
        if (substrRegex.test(str)) {
          matches.push(str);
        }
      });

      cb(matches);
    };
  };
  var data_search = [
    'Badan Penanggulangan Bencana Daerah',
    'Badan Pengelolaan Keuangan dan Aset Daerah',
    'Badan Perencanaan Pembangunan Daerah dan LITBANG',
    'Bagian Hukum',
    'Bagian Perkonomian dan Kesejahteraan Rakyat',
    'Bagian Organisasi',
    'Bagian Administrasi Pembangunan',
    'Bagian Administari Pemerintahan',
    'Bagian Umum',
    'Dinas Kependudukan dan Pencatatan Sipil',
    'Dinas Kesehatan',
    'Dinas Komunikasi dan Informatika',
    'Dinas Lingkungan Hidup',
    'Dinas Pariwisata, Pemuda dan Olahraga',
    'Dinas Pekerjaan Umum, Penataan Ruang, Perumahan dan Kawasan Pemukiman',
    'Dinas Penanaman Modal, Transmigrasi dan PTSP',
    'Dinas Pendidikan dan Kebudayaan',
    'Dinas Perindustrian, Perdagangan, Koperasi dan UKM',
    'Dinas Pertanian Pangan dan Perikanan',
    'Dinas Sosial, Pemberdayaan Masyarakat dan Desa',
    'Inspektur Kabupaten Tana Tidung',
    'Kemenag Kabupaten Tana Tidung',
    'Kesatuan Bangsa dan Politik',
    'Satuan Polisi Pamong Praja',
    'Sekretariat DPRD',
    'Dinas Pehubungan',
    'Dinas Perpustakaan dan Kearsipan',
    'Dinas Pemadam Kebakaran dan Penyelamatan',
    'Dinas Tenaga Kerja dan Transmigrasi',

  ];

  if (isRtl) {
    $('.typeahead').attr('dir', 'rtl');
  }

  // Basic
  // --------------------------------------------------------------------
  $('.typeahead').typeahead({
    hint: !isRtl,
    highlight: true,
    minLength: 1
  }, {
    name: 'data_search',
    source: substringMatcher(data_search)
  });

  var bloodhoundBasicExample = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: data_search
  });
  // --------------------------------------------------------------------
  // Users List suggestion
  //------------------------------------------------------
  const TagifyUserListEl = document.querySelector('#TagifyUserList');

  const usersList = [{
      value: 1,
      name: 'Justinian Hattersley',
      avatar: 'https://i.pravatar.cc/80?img=1',
      email: 'jhattersley0@ucsd.edu'
    },
    {
      value: 2,
      name: 'Antons Esson',
      avatar: 'https://i.pravatar.cc/80?img=2',
      email: 'aesson1@ning.com'
    },
    {
      value: 3,
      name: 'Ardeen Batisse',
      avatar: 'https://i.pravatar.cc/80?img=3',
      email: 'abatisse2@nih.gov'
    },
    {
      value: 4,
      name: 'Graeme Yellowley',
      avatar: 'https://i.pravatar.cc/80?img=4',
      email: 'gyellowley3@behance.net'
    },
    {
      value: 5,
      name: 'Dido Wilford',
      avatar: 'https://i.pravatar.cc/80?img=5',
      email: 'dwilford4@jugem.jp'
    },
    {
      value: 6,
      name: 'Celesta Orwin',
      avatar: 'https://i.pravatar.cc/80?img=6',
      email: 'corwin5@meetup.com'
    },
    {
      value: 7,
      name: 'Sally Main',
      avatar: 'https://i.pravatar.cc/80?img=7',
      email: 'smain6@techcrunch.com'
    },
    {
      value: 8,
      name: 'Grethel Haysman',
      avatar: 'https://i.pravatar.cc/80?img=8',
      email: 'ghaysman7@mashable.com'
    },
    {
      value: 9,
      name: 'Marvin Mandrake',
      avatar: 'https://i.pravatar.cc/80?img=9',
      email: 'mmandrake8@sourceforge.net'
    },
    {
      value: 10,
      name: 'Corrie Tidey',
      avatar: 'https://i.pravatar.cc/80?img=10',
      email: 'ctidey9@youtube.com'
    }
  ];

  function tagTemplate(tagData) {
    return `
    <tag title="${tagData.title || tagData.email}"
      contenteditable='false'
      spellcheck='false'
      tabIndex="-1"
      class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ''}"
      ${this.getAttributes(tagData)}
    >
      <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
      <div>
        <div class='tagify__tag__avatar-wrap'>
          <img onerror="this.style.visibility='hidden'" src="${tagData.avatar}">
        </div>
        <span class='tagify__tag-text'>${tagData.name}</span>
      </div>
    </tag>
  `;
  }

  function suggestionItemTemplate(tagData) {
    return `
    <div ${this.getAttributes(tagData)}
      class='tagify__dropdown__item align-items-center ${tagData.class ? tagData.class : ''}'
      tabindex="0"
      role="option"
    >
      ${
        tagData.avatar
          ? `<div class='tagify__dropdown__item__avatar-wrap'>
          <img onerror="this.style.visibility='hidden'" src="${tagData.avatar}">
        </div>`
          : ''
      }
      <strong>${tagData.name}</strong>
      <span>${tagData.email}</span>
    </div>
  `;
  }

  // initialize Tagify on the above input node reference
  let TagifyUserList = new Tagify(TagifyUserListEl, {
    tagTextProp: 'name', // very important since a custom template is used with this property as text. allows typing a "value" or a "name" to match input with whitelist
    enforceWhitelist: true,
    skipInvalid: true, // do not remporarily add invalid tags
    dropdown: {
      closeOnSelect: false,
      enabled: 0,
      classname: 'users-list',
      searchKeys: ['name', 'email'] // very important to set by which keys to search for suggesttions when typing
    },
    templates: {
      tag: tagTemplate,
      dropdownItem: suggestionItemTemplate
    },
    whitelist: usersList
  });

  TagifyUserList.on('dropdown:show dropdown:updated', onDropdownShow);
  TagifyUserList.on('dropdown:select', onSelectSuggestion);

  let addAllSuggestionsEl;

  function onDropdownShow(e) {
    let dropdownContentEl = e.detail.tagify.DOM.dropdown.content;

    if (TagifyUserList.suggestedListItems.length > 1) {
      addAllSuggestionsEl = getAddAllSuggestionsEl();

      // insert "addAllSuggestionsEl" as the first element in the suggestions list
      dropdownContentEl.insertBefore(addAllSuggestionsEl, dropdownContentEl.firstChild);
    }
  }

  function onSelectSuggestion(e) {
    if (e.detail.elm == addAllSuggestionsEl) TagifyUserList.dropdown.selectAll.call(TagifyUserList);
  }

  // create an "add all" custom suggestion element every time the dropdown changes
  function getAddAllSuggestionsEl() {
    // suggestions items should be based on "dropdownItem" template
    return TagifyUserList.parseTemplate('dropdownItem', [{
      class: 'addAll',
      name: 'Tambah Semua',
      email: TagifyUserList.settings.whitelist.reduce(function (remainingSuggestions, item) {
        return TagifyUserList.isTagDuplicate(item.value) ? remainingSuggestions : remainingSuggestions + 1;
      }, 0) + ' Members'
    }]);
  }
  // --------------------------------------------------------------------


});
