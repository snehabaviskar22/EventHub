<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>EventHub Ticket - {{ $ticket->ticket_id }}</title>

<style>

*{
    font-family: DejaVu Sans, Helvetica, Arial, sans-serif;
    box-sizing:border-box;
}

body{
    margin:0;
    padding:25px;
    background:#FDF7F3;
    color:#2D1B3D;
}

.ticket{
    width:100%;
    border:3px solid #7C3AED;
    border-radius:18px;
    overflow:hidden;
    background:#ffffff;
}


/* ================= HEADER ================= */

.header{
    background:#7C3AED;
    color:white;
    padding:28px 35px;
}

.header-table{
    width:100%;
    border-collapse:collapse;
}

.header-table td{
    vertical-align:middle;
}

.logo{
    font-size:32px;
    font-weight:bold;
    letter-spacing:.5px;
}

.tagline{
    font-size:13px;
    color:#FDE68A;
    margin-top:4px;
}

.status{
    text-align:right;
}

.badge{
    display:inline-block;
    background:#16A34A;
    color:white;
    padding:8px 18px;
    border-radius:18px;
    font-size:12px;
    font-weight:bold;
    text-transform:uppercase;
}


/* ================= BODY ================= */

.content{
    padding:35px;
}

.small-title{
    font-size:11px;
    color:#7C3AED;
    text-transform:uppercase;
    font-weight:bold;
    letter-spacing:1px;
}

.ticket-id{
    font-size:34px;
    color:#7C3AED;
    font-weight:bold;
    margin:6px 0 20px;
}

.event-name{
    font-size:28px;
    color:#2D1B3D;
    font-weight:bold;
    margin:6px 0 25px;
}

.line{
    border-top:2px dashed #D8B4FE;
    margin:25px 0;
}


/* ================= DETAILS ================= */

.details{
    width:100%;
    border-collapse:collapse;
}

.details td{
    width:50%;
    padding:14px 8px;
    vertical-align:top;
}

.label{
    font-size:11px;
    color:#7C3AED;
    font-weight:bold;
    text-transform:uppercase;
    letter-spacing:1px;
    margin-bottom:5px;
}

.value{
    font-size:17px;
    color:#2D1B3D;
    font-weight:bold;
}


/* ================= FOOTER ================= */

.footer{
    background:#FAF5FF;
    border-top:2px solid #E9D5FF;
    text-align:center;
    padding:18px;
    color:#555;
    font-size:12px;
    line-height:1.7;
}

.bottom{
    height:8px;
    background:#EC4899;
}

</style>

</head>

<body>

<div class="ticket">

    <div class="header">

        <table class="header-table">
            <tr>

                <td>
                    <div class="logo">EventHub</div>
                    <div class="tagline">
                        College Event Management & Ticket Booking
                    </div>
                </td>

                <td class="status">
                    <span class="badge">
                        {{ strtoupper($ticket->payment_status) }}
                    </span>
                </td>

            </tr>
        </table>

    </div>


    <div class="content">

        <div class="small-title">Ticket ID</div>
        <div class="ticket-id">
            {{ $ticket->ticket_id }}
        </div>

        <div class="small-title">Event</div>

        <div class="event-name">
            {{ $ticket->event->title }}
        </div>

        <div class="line"></div>


        <table class="details">

            <tr>

                <td>
                    <div class="label">Student Name</div>
                    <div class="value">{{ $ticket->user->name }}</div>
                </td>

                <td>
                    <div class="label">Academic Program</div>
                    <div class="value">{{ $ticket->academic_program }}</div>
                </td>

            </tr>

            <tr>

                <td>
                    <div class="label">Date</div>
                    <div class="value">
                        {{ $ticket->event->event_date->format('F d, Y') }}
                    </div>
                </td>

                <td>
                    <div class="label">Time</div>
                    <div class="value">
                        {{ $ticket->event->start_time->format('g:i A') }}
                        -
                        {{ $ticket->event->end_time->format('g:i A') }}
                    </div>
                </td>

            </tr>

            <tr>

                <td>
                    <div class="label">Venue</div>
                    <div class="value">
                        {{ $ticket->event->venue }}
                    </div>
                </td>

                <td>
                    <div class="label">Booking Date</div>
                    <div class="value">
                        {{ $ticket->booking_date->format('M d, Y') }}
                    </div>
                </td>

            </tr>

            <tr>

                <td>
                    <div class="label">Ticket Quantity</div>
                    <div class="value">
                        {{ $ticket->ticket_quantity }}
                    </div>
                </td>

                <td>
                    <div class="label">Payment Status</div>
                    <div class="value">
                        {{ strtoupper($ticket->payment_status) }}
                    </div>
                </td>

            </tr>

        </table>

        <div class="line"></div>

    </div>


    <div class="footer">

        Please present this ticket at the event entrance.<br>

        This is a computer-generated ticket.<br>

        © {{ date('Y') }} EventHub

    </div>

    <div class="bottom"></div>

</div>

</body>
</html>