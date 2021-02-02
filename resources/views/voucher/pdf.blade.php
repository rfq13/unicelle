<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
	html *
{
		font-family: 'Lato', Helvetica, Arial, sans-serif;
	}
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> We're thrilled to have you here! Get ready to dive into your new account. </div>
    
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" style="margin: 30px;">
		<div class="row">
				<div class="col-md-12" style="text-align:center">
		<img loading="lazy" style="width: 300px;"  class="img-md" src="{{ my_asset($detail->voucher->thumbnail)}}" alt="Image">
			</div>
			<div style="height:10px">
			</div>
			<h2 style="font-weight:bold">
				{{$detail->voucher->merchant}} - {{$detail->voucher->judul}}
			</h2>
			<div style="height:10px">
			</div>
            <div>
            <table class="table table-striped" style="width: 100%;color:#FFA500">
  <thead>
    <th style="text-align:left"><h3>Potongan</h3></th>
    <th style="text-align:right"><h3>Rp. {{$detail->voucher->potongan}}</h3></th>
    </thead>
    </table>
            </div>
			<div>
            <table class="table table-striped" style="width: 100%;color:#FFA500">
  <thead>
    <th style="text-align:left"><h3>Poin Ditukarkan</h3></th>
    <th style="text-align:right"><h3>{{$detail->voucher->point}}</h3></th>
    </thead>
    </table>
            </div>
            <div>
            <table class="table table-striped" style="width: 100%;color:#FFA500">
  <thead>
    <th style="text-align:left"><h3>Kode Voucher</h3></th>
    <th style="text-align:right"><h3>{{$detail->code}}</h3></th>
    </thead>
    </table>
            </div>

<div style="height:10px">
			</div>
			<h2 style="font-weight:bold">
				Syarat & Ketentuan
			</h2>
			<p>{!! $detail->voucher->syarat !!}</p>
<div style="height:10px">
			</div>
<h2 style="font-weight:bold">
				Cara Pemakaian
			</h2>
			<p>{!! $detail->voucher->cara !!}</p>
<div style="height:10px">
			</div>

		</div>
		</div>
		<div class="col-md-12" style="background: url('{{ my_asset('images/bg-date-pdf.png') }}');background-repeat: no-repeat;
  background-size: cover;">
		<div class="row" style="    text-align: right;">
			<p style="margin-bottom: 0;
    font-weight: bold;
    font-size: 18px;">Berlaku Sampai :</p>
            @php
        \Carbon\Carbon::setLocale('id');
        $tgl = \Carbon\Carbon::parse(date('d-m-Y', $detail->voucher->end_date));
       
        @endphp
			<p style="    margin-top: 0;
    font-weight: bold;
    font-size: 18px;color:#FFA500">{{ $tgl->isoFormat('D MMMM Y') }}</p>

			</div>
			</div>
			<div style="height:10px">
			</div>
	</div>
</div>
</body>

</html>
