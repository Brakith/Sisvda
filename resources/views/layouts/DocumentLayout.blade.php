<html>
    <head>
        <style>
            @page {
                margin: 0cm 0cm;
                font-family: Arial;
            }

            body{
                margin: 1.2cm 1.2cm 1.2cm 1.2cm;
                font-size: 16px;
            }
     
            main{
                margin-bottom: 4cm;
            }
     
            header {
                position: fixed;
                top: 1cm;
                left:1cm;
                right: 1cm;
                height: 3.7cm;
                background-color: #2a0927;
                text-align: center;
            }
     
            footer {
                position: fixed;
                bottom: 1cm;
                left: 1cm;
                right: 1cm;
                height: 3cm;
                text-align: center;
                line-height: normal;
                {{-- background-color: #2a2222; --}}
                font-size: 0.68rem;
            }

            table{
                border-collapse:collapse;
            }

            .footer-title{
                color: white;
                font-weight: bold;
                text-transform: uppercase;
                padding: 0.25rem;
                background-color: #343a40;
            }

            .footer-p{
                padding: 0.25rem;
                background-color: #f8f9fa;
                color: #212529;
            }

            .footer-hash{
                color: white;
                font-weight: bold;
                padding: 0.25rem;
                background-color: #dc3545;
            }

            h1, h2, h3, h4, h5, h6{
                margin-top: 0.5rem;
                margin-bottom: 0.5rem;
                line-height: 1.2;
                box-sizing: border-box;
            }

            p{
                font-size: 1rem;
                font-weight: normal;
                text-align: justify;
                line-height: 1.5;
            }

            .container{
                max-width: 1140px;
                width:80%;
                padding-right:15px;
                padding-left:15px;
                margin-right:auto;
                margin-left:auto
            }

            .header-title{
                margin-top: 0px;
                font-weight: bold;
                font-size: 1.25rem;
                text-align: center;
                text-transform: uppercase;
            }
            
            .header-comment{
                font-size: 1rem;
                text-align: center;
                font-weight: normal;
            }
            
            .header-subtitle{
                font-weight: bold;
                font-size: 1rem;
                text-transform: uppercase;
                text-align: center;
            }

            .header-date{
                font-weight: bold;
                font-size: 1rem;
                text-transform: uppercase;
                text-align: right;
            }
            
            .title{
                margin-top: 1rem 0rem 1rem 0rem;
                font-weight: bold;
                font-size: 1.5rem;
                text-align: center;
                text-transform: uppercase;
            }

            .subtitle{
                font-weight: bold;
                font-size: 1.25rem;
                text-align: left;
                text-transform: normal;
            }

            .table{
                width:100%;
                margin-top: 1rem;
                margin-bottom:1rem;
                background-color:transparent;
                font-size: 0.6875rem;
                font-weight: normal;
            }
                
            .table td,.table th{
                padding:.75rem;
                vertical-align:top;
                text-align: left;
                border-top:1px solid #dee2e6;
            }
            .table thead th{
                vertical-align:bottom;
                border-bottom:2px solid #dee2e6;
                font-weight: bold;
            }
            
            .table tbody+tbody{
                border-top:2px solid #dee2e6;
                font-weight: normal;
            }
            
            .table .table{
                background-color:#f8fafc;
            }

            .page-break {
                page-break-after: always;
            }

            
            .font-size-1rem{
                font-size: 1rem;
                font-weight: normal;
            }

            .font-weight-bold{
                font-weight: 700;
            }

            .float-left{
                float: left;
            }

            .float-right{
                float: right;
            }

            .text-center{
                text-align: center;
            } 

            .text-right{
                text-align: right;
            } 
            
            .text-uppercase{
                text-transform:uppercase;
            }

            .bg-primary {
                background-color:#3490dc;
            }
            
            .text-white{
                color:#fff;
            }      
        </style>

    </head>
    <body>
        @yield('content')
    </body>
    </html>