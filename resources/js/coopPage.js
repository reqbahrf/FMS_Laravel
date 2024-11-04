window.initilizeCoopPageJs = async () => {
    const functions = {
        Dashboard: () => {

            const progressPercentage = (percentage) => {
                const options = {
                    series: [percentage],
                    chart: {
                        height: 250,
                        width: 250,
                        type: 'radialBar',
                        toolbar: {
                            show: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -135,
                            endAngle: 225,
                            hollow: {
                                margin: 0,
                                size: '70%',
                                background: '#fff',
                                image: undefined,
                                imageOffsetX: 0,
                                imageOffsetY: 0,
                                position: 'front',
                                dropShadow: {
                                    enabled: true,
                                    top: 3,
                                    left: 0,
                                    blur: 4,
                                    opacity: 0.24
                                }
                            },
                            track: {
                                background: '#fff',
                                strokeWidth: '50%',
                                margin: 0, // margin is in pixels
                                dropShadow: {
                                    enabled: true,
                                    top: -3,
                                    left: 0,
                                    blur: 4,
                                    opacity: 0.35
                                }
                            },

                            dataLabels: {
                                show: true,
                                name: {
                                    offsetY: -10,
                                    show: true,
                                    color: '#888',
                                    fontSize: '17px'
                                },
                                value: {
                                    formatter: function(val) {
                                        return parseInt(val);
                                    },
                                    color: '#111',
                                    fontSize: '36px',
                                    show: true,
                                }
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            type: 'horizontal',
                            shadeIntensity: 0.5,
                            gradientToColors: ['#ABE5A1'],
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100]
                        }
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    labels: ['Percent'],
                };

                const chart = new ApexCharts(document.querySelector("#ProgressPer"), options).render();
              ;
            }


            const formatToString = (value) => {
            return value.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        };

        const getProgress = async () => {
            const paymentTextPer = $('#ProgressPerText')
            try {
                const response = await fetch(DASHBOARD_ROUTE.GET_COOPERATOR_PROGRESS, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json'
                });
                const data = await response.json();
                paymentTableProcess(data.paymentList);

                 const actual_amount = parseFloat(data.progress.actual_amount_to_be_refund) || 0;
                 const refunded_amount = parseFloat(data.progress.refunded_amount) || 0;
                 const percentage = Math.ceil((refunded_amount / actual_amount) * 100);

                 paymentTextPer.html(`<h5>${formatToString(refunded_amount)} / ${formatToString(actual_amount)}</h5>`);
                progressPercentage(percentage);


            } catch (error) {
                console.error(error)

            }
        }



        const paymentTableProcess = (data) => {
            const paymentTable = $('#PaymentTable').find('tbody');
            paymentTable.empty();
            $.each(data, function(key, value) {
                const statusClass = value.payment_status === "Paid" ? "bg-success" : "bg-danger";
                const row = `<tr>
                  <td class="text-center">${formatToString(value.amount)}</td>
                  <td class="text-center">${value.payment_method}</td>
                  <td class="text-center"><span class="badge rounded-pill ${statusClass}">${value.payment_status}</span></td>
                 </tr>`;
                paymentTable.append(row);
            });
        }

        getProgress();

        },

        Requirements: () => {
            function initializeFilePond() {
                const inputElement = document.querySelector('.filepond-receipt-upload');
                const receiptFilePondInit = FilePond.create(inputElement, {
                    acceptedFileTypes: ['image/*'],
                    imagePreviewHeight: 170,
                    imageCropAspectRatio: '1:1',
                    imageResizeTargetWidth: 200,
                    imageResizeTargetHeight: 200,
                    server: {
                        process: {
                            url: '/upload/Img',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            onload: (response) => {
                                const data = JSON.parse(response);
                                if (data.temp_file_path && data.unique_id) {
                                    // Store unique_id in a hidden input field or as a data attribute
                                    document.querySelector('input[name="unique_id"]').value = data.unique_id;
                                    inputElement.setAttribute('data-unique-id', data.unique_id);
                                    if (data.temp_file_path) {
                                        inputElement.setAttribute('data-file-path', data.temp_file_path);
                                    }
                                }
                                return data.unique_id;
                            }
                        },
                        revert: (uniqueFileId, load, error) => {
                            const receiptPath = inputElement.getAttribute('data-file-path');
                            const unique_id = inputElement.getAttribute('data-unique-id');

                            console.log('Reverting file with path:', receiptPath, 'and unique ID:', unique_id);

                            fetch(`/delete/Img/{uniqueId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify({
                                    receiptfilePath: receiptPath
                                })
                            }).then(response => {
                                if (response.ok) {
                                    load();
                                } else {
                                    console.error('Failed to delete file:', response.statusText);
                                }
                            }).catch(() => {
                                error('Failed to delete file');
                            });
                        } // Revert is not needed for temporary files
                    }
                })

                const form = document.getElementById('uploadForm');
                const receiptName = document.getElementById('receiptName');
                window.submissionModal = new bootstrap.Modal(document.getElementById('receiptModal'));
                const successMessage = document.getElementById('successMessage');
                const submitBtn = document.getElementById('submitButton');

                submitButton.addEventListener('click', function(event) {
                    event.preventDefault();

                    const formData = new FormData(form);

                    fetch(REQUIREMENTS_ROUTE.STORE_RECEIPTS, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                successMessage.textContent = data.success;
                                successMessage.style.display = 'block';
                                successMessage.classList.add('alert', 'alert-success');

                                setTimeout(() => {
                                    receiptName.value = '';
                                    receiptFilePondInit.removeFile();
                                    successMessage.style.display = 'none';
                                    successMessage.classList.remove('alert', 'alert-success');
                                    submissionModal.hide();
                                    getReceipt();
                                }, 1000);
                            } else {
                                console.error(data.error);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            }

            function getReceipt() {
                fetch(REQUIREMENTS_ROUTE.GET_RECEIPTS, {
                        method: 'GET',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        let tableBody = $('#expenseReceipt_tbody');
                        tableBody.empty(); // Clear the existing rows

                        $.each(data, function(key, value) {
                            const receiptImage =
                                `<img src="data:image/png;base64,${value.receipt_image}" alt="${value.receipt_name}" style="max-width: 200px; max-height: 200px;" />`;
                            const row = `<tr>
                        <td>${value.receipt_name}</td>
                        <td>${value.receipt_description}</td>
                        <td class="img-Content">${receiptImage}</td>
                        <td>${value.created_at}</td>
                        <td>${value.remark}</td>
                        <td></td>
                    </tr>`;

                            tableBody.append(row);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }


            initializeFilePond();
            getReceipt();
        },

        QuarterlyReport: () => {

        }

    }
    return functions
}
