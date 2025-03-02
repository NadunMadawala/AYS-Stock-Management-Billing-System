<style>
    @media print {
        h3.heding {
            background: black;
            color: white;
            padding: 6px;
        }

        .print {
            display: none;
        }

    }

    table {
        border-collapse: collapse;
        table-layout: fixed;
    }

    table th {
        color: black;
        text-align: left;
        padding: 3px;

    }

    table td {
        color: #202020;
        padding: 3px;
    }

    td.right,
    th.right {
        text-align: right !important;
    }

    .without-border td {
        border: none;
    }

    td.top,
    th.top {
        vertical-align: top;
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .top {
        background: black;
        color: white;
        padding: 6px;
    }

    td.paddingForCheckbox {
        padding-left: 5em;
    }

    hr.new4 {
        border: 1px solid black;
    }

    p.condition {
        color: black;
        text-transform: uppercase;
    }

    @media print {
        .braker {
            page-break-after: always;
        }
    }

    #component1 {
        width: 912px;
        height: 150px;
        border: none;
        Padding: 24px;
        padding-top: 230PX;
        font-size: 12pt;
        font-family: arial;
        background-color: rgba(169, 169, 169, 0.194);
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    }
</style>
<div class="card-body" style="height: 500px">
    <!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <div class="row">
        <div class="col-lg-2">
            <div align="right" margin=100px;>
                <button class="btn btn-info print" onclick="window.print()">Print Document</button>

            </div>
        </div>
    </div>
    <br><br><br>
    <div id="component1">

        <table style="padding-top: 50PX">
            <tbody>
                <td>
                    <div style="font-size: 18px;">
                        <address>
                            Dr.Kavinda Jayawardena (M.B.B.S)<br>
                            Member of Parliament,<br>
                            No.34,<br>
                            Dr. Jayalath Jayawardena Mw, <br>
                            Weligampitiya, Jaela.
                        </address>
                    </div>
                </td>

                <td>
                    <div style="margin-left: 350px; font-size: 18px;">
                        @foreach ($printdetail as $item)
                            <address>
                                {{ $item->fldAddLine1 }} <br>
                                {{ $item->fldAddLine2 }}<br>
                                {{ $item->fldAddLine3 }}<br>
                                {{ $item->fldAddLine4 }}<br>
                                {{ $item->fldAddLine5 }}
                            </address>
                        @endforeach

                    </div>
                </td>

            </tbody>
        </table>
    </div>

    </html>
</div>
