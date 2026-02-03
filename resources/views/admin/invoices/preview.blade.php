<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .invoice-letter {
            border: 1px solid #ddd;
            padding: 30px;
            background: #fff;
        }

        /* HEADER */
        .header-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .header-table td {
            vertical-align: middle;
        }

        h2 {
            margin: 0;
            letter-spacing: 2px;
        }

        .muted {
            color: #777;
            font-size: 11px;
        }

        hr {
            border: none;
            border-top: 1px dashed #ccc;
            margin: 20px 0;
        }

        h6 {
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 6px;
        }

        p {
            margin: 4px 0;
        }

        /* SUMMARY */
        .total-amount {
            font-size: 20px;
            font-weight: bold;
        }

        /* BADGES */
        .badge {
            padding: 8px 14px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 20px;
            display: inline-block;
        }

        .badge-success {
            background: #e6f4ea;
            color: #1e7e34;
            border: 1px solid #b7dfc5;
        }

        .badge-danger {
            background: #fdecea;
            color: #a71d2a;
            border: 1px solid #f5b5b0;
        }

        /* TABLE UTIL */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        /* ACTION NOTE */
        .download-note {
            margin-top: 20px;
            font-size: 11px;
            color: #666;
            text-align: right;
        }

        /* 🔥 DOWNLOAD BUTTON – NO CONFUSION */
        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #111, #333);
            color: #fff;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .download-btn i {
            font-size: 1.1rem;
        }

        .download-btn:hover {
            background: linear-gradient(135deg, #000, #222);
            transform: translateY(-3px);
            box-shadow: 0 18px 40px rgba(0,0,0,0.3);
            color: #fff;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="invoice-letter">

        <!-- HEADER -->
        <table class="header-table">
            <tr>
                <td>
                    <img src="{{ asset('logobloomp.png') }}" style="max-height:70px;">
                </td>
                <td class="text-right">
                    <h2>INVOICE</h2>
                    <div class="muted">#{{ $invoice->invoice_number }}</div>
                    <h2>Sales Man</h2>
                    <div class="muted">{{ $invoice->user->name }}</div>
                </td>
            </tr>
        </table>

        <hr>

        <!-- CUSTOMER INFO -->
        <table>
            <tr>
                <td width="50%">
                    <h6>Billed To</h6>
                    <p><strong>{{ $invoice->customer->name }}</strong></p>
                    <p class="muted">{{ $invoice->customer->email }}</p>
                    <p class="muted">{{ $invoice->customer->phone }}</p>
                </td>
                <td width="50%" class="text-right">
                    <h6>Invoice Date</h6>
                    <p>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y') }}</p>
                </td>
            </tr>
        </table>

        <hr>

        <!-- SUMMARY -->
        <table>
            <tr>
                <td>
                    <p class="muted">Total Amount</p>
                    <div class="total-amount">
                        ₦{{ number_format($invoice->total, 2) }}
                    </div>
                </td>
                <td class="text-right">
                    @if($invoice->payment_status === 'owing')
                        <span class="badge badge-danger">
                            Owing ₦{{ number_format($invoice->balance, 2) }}
                        </span>
                    @else
                        <span class="badge badge-success">
                            Fully Paid
                        </span>
                    @endif
                </td>
            </tr>
        </table>

        <hr>

        <!-- NOTE -->
        <div class="download-note">
            Generated invoice document
        </div>

        <!-- Actions -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.invoices.download', $invoice->id) }}"
                   class="btn btn-dark px-4 download-btn">
                    <i class="fas fa-file-pdf "></i>
                    Download PDF
                </a>
            </div>

    </div>
</div>

</body>
</html>
