@extends('theme::layouts.right-sidebar')

@section('content')
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        <div class="px-6 py-8 md:px-10 md:py-10 border-b border-gray-200">
            <div class="space-y-3">
                <p class="text-sm uppercase tracking-[0.25em] text-primary font-semibold">Arsip Konten</p>
                <h1 class="text-3xl font-bold text-gray-900">Konten Situs Web {{ $desa['nama_desa'] }}</h1>
                <p class="text-gray-600 max-w-2xl">Daftar artikel arsip terbaru lengkap dengan tanggal, penulis, dan jumlah pembaca.</p>
            </div>
        </div>

        <div class="px-4 py-6 md:px-8 md:py-8 overflow-x-auto">
            <table id="arsip-artikel" class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-primary to-primary-dark text-white">
                        <th class="px-4 py-3 text-center font-semibold w-12 arsip-col-hide">No.</th>
                        <th class="px-4 py-3 text-left font-semibold arsip-col-date">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold">Judul Artikel</th>
                        <th class="px-4 py-3 text-left font-semibold arsip-col-hide">Penulis</th>
                        <th class="px-4 py-3 text-center font-semibold arsip-col-hide">Dibaca</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100"></tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        /* ── Tabel ── */
        #arsip-artikel tbody tr {
            transition: background-color 0.2s ease;
        }
        #arsip-artikel tbody tr:nth-child(odd) {
            background-color: #f9fafb;
        }
        #arsip-artikel tbody tr:hover {
            background-color: #f0fdf4;
        }
        #arsip-artikel td {
            white-space: normal;
            vertical-align: middle;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f3f4f6;
        }
        #arsip-artikel th {
            white-space: nowrap;
        }
        /* Panah sort — override Glyphicons dengan Unicode biasa */
        #arsip-artikel thead th.sorting,
        #arsip-artikel thead th.sorting_asc,
        #arsip-artikel thead th.sorting_desc {
            padding-right: 28px !important;
            position: relative;
        }
        #arsip-artikel thead th.sorting::after,
        #arsip-artikel thead th.sorting_asc::after,
        #arsip-artikel thead th.sorting_desc::after {
            font-family: inherit !important;
            position: absolute;
            right: 8px;
            bottom: 50%;
            transform: translateY(50%);
            display: block !important;
            opacity: 1 !important;
            font-size: 12px;
            line-height: 1;
            color: rgba(255, 255, 255, 0.6) !important;
        }
        #arsip-artikel thead th.sorting::after       { content: "⇅" !important; }
        #arsip-artikel thead th.sorting_asc::after   { content: "↑" !important; color: #fff !important; }
        #arsip-artikel thead th.sorting_desc::after  { content: "↓" !important; color: #fff !important; }

        /* ── Reset wrapper default DataTables ── */
        .dataTables_wrapper {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        /* ── Controls: length + search (atas tabel) ── */
        .datatable-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin: 0;
            padding: 0;
        }
        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            color: #374151;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
        }
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.4rem 0.75rem;
            font-size: 0.875rem;
            background-color: #fff;
            color: #374151;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15);
        }

        /* ── Footer: info + pagination (bawah tabel) ── */
        .datatable-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.25rem;
            padding-top: 1rem;
            border-top: 1px solid #f3f4f6;
        }
        .dataTables_wrapper .dataTables_info {
            font-size: 0.8125rem;
            color: #6b7280;
            margin: 0;
            padding: 0;
        }

        /* ── Pagination ── */
        .dataTables_wrapper .dataTables_paginate {
            margin: 0;
            padding: 0;
        }
        .dataTables_wrapper .dataTables_paginate ul.pagination {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.25rem;
            margin: 0;
            list-style: none;
            padding: 0;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            min-width: 2rem;
            height: 2rem;
            padding: 0 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            color: #4b5563;
            font-size: 0.875rem;
            background-color: #fff;
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0;
            white-space: nowrap;
            line-height: 1;
            text-decoration: none !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled) {
            background-color: #22c55e;
            color: #fff !important;
            border-color: #22c55e;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background-color: #22c55e !important;
            color: #fff !important;
            border-color: #22c55e !important;
            font-weight: 600;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            background-color: #f9fafb !important;
            color: #d1d5db !important;
            border-color: #e5e7eb !important;
            cursor: not-allowed;
        }

        /* ── Processing overlay ── */
        .dataTables_wrapper .dataTables_processing {
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.07);
            font-size: 0.875rem;
            color: #374151;
        }

        /* ── Responsif mobile ── */
        @media (max-width: 640px) {
            .datatable-controls {
                flex-direction: column;
                align-items: flex-start;
            }
            .datatable-footer {
                flex-direction: column;
                align-items: center;
            }
        }
        @media (max-width: 767px) {
            .arsip-col-hide { display: none !important; }
            .arsip-col-date { white-space: nowrap; width: 80px; }
        }
    </style>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            var arsip = $('#arsip-artikel').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ordering: true,
                pageLength: 15,
                lengthMenu: [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
                dom: '<"datatable-controls"lf>t<"datatable-footer"ip>',
                language: {
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data",
                    emptyTable: "Tidak ada artikel arsip",
                    zeroRecords: "Tidak ada artikel yang cocok",
                    search: "Cari:",
                    paginate: {
                        first: '&laquo;',
                        last: '&raquo;',
                        next: '&rsaquo;',
                        previous: '&lsaquo;'
                    },
                    loadingRecords: "Memuat...",
                    processing: "Memproses..."
                },
                ajax: {
                    url: `{{ ci_route('internal_api.arsip') }}`,
                    method: 'get',
                    data: function(row) {
                        return {
                            "page[size]": row.length,
                            "page[number]": (row.start / row.length) + 1,
                            "filter[search]": row.search.value,
                            "sort": (row.order[0]?.dir === "asc" ? "" : "-") + row.columns[row.order[0]?.column]?.name,
                        };
                    },
                    dataSrc: function(json) {
                        json.recordsTotal = json.meta.pagination.total
                        json.recordsFiltered = json.meta.pagination.total
                        return json.data
                    },
                },
                columnDefs: [
                    { targets: 0, className: 'text-center arsip-col-hide' },
                    { targets: 1, className: 'arsip-col-date' },
                    { targets: 2, className: 'font-medium text-gray-800' },
                    { targets: 3, className: 'arsip-col-hide' },
                    { targets: 4, className: 'text-center arsip-col-hide' }
                ],
                columns: [
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) { return ''; }
                    },
                    {
                        data: "attributes.tgl_upload_local",
                        name: "tgl_upload",
                        render: function(data) {
                            return '<span class="text-gray-500 text-xs">' + data + '</span>';
                        }
                    },
                    {
                        data: function(data) {
                            return `<a href="${data.attributes.url_slug}" class="text-primary font-medium hover:underline transition-colors">${data.attributes.judul}</a>`;
                        },
                        name: "judul",
                        orderable: false
                    },
                    {
                        data: "attributes.author.nama",
                        name: "id_user",
                        defaultContent: '<span class="text-gray-400">-</span>',
                        searchable: false,
                        orderable: false,
                        render: function(data) {
                            return data ? '<span class="text-gray-700">' + data + '</span>' : '<span class="text-gray-400">-</span>';
                        }
                    },
                    {
                        data: "attributes.hit",
                        name: "hit",
                        searchable: false,
                        render: function(data) {
                            return '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">' + data + '</span>';
                        }
                    },
                ],
                order: [[1, 'desc']],
                drawCallback: function() {
                    var PageInfo = arsip.page.info();
                    $('.dataTables_info').text('Halaman ' + (PageInfo.page + 1) + ' dari ' + PageInfo.pages);
                }
            });

            arsip.on('draw.dt', function() {
                var PageInfo = $('#arsip-artikel').DataTable().page.info();
                arsip.column(0, { page: 'current' }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });
        });
    </script>
@endpush
