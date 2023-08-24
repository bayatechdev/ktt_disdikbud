/**
 * App Invoice List (jquery)
 */

'use strict';


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
  const textarea = document.querySelector('#kegiatan');
  if (textarea) {
    autosize(textarea);
  }
  const textarea2 = document.querySelector('#keterangan');
  if (textarea2) {
    autosize(textarea2);
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
  var wilayah = [
    'Aceh',
    'Sumatera Utara',
    'Sumatera Barat',
    'Riau',
    'Jambi',
    'Sumatera Selatan',
    'Bengkulu',
    'Lampung',
    'Kepulauan Bangka Belitung',
    'Kepulauan Riau',
    'DKI Jakarta',
    'Jawa Barat',
    'Jawa Tengah',
    'DI Yogyakarta',
    'Jawa Timur',
    'Banten',
    'Bali',
    'Nusa Tenggara Barat',
    'Nusa Tenggara Timur',
    'Kalimantan Barat',
    'Kalimantan Tengah',
    'Kalimantan Selatan',
    'Kalimantan Timur',
    'Kalimantan Utara',
    'Sulawesi Utara',
    'Sulawesi Tengah',
    'Sulawesi Selatan',
    'Sulawesi Tenggara',
    'Gorontalo',
    'Sulawesi Barat',
    'Maluku',
    'Maluku Utara',
    'Papua',
    'Papua Barat',
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
    name: 'wilayah',
    source: substringMatcher(wilayah)
  });

  var bloodhoundBasicExample = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: wilayah
  });
  // --------------------------------------------------------------------
});
