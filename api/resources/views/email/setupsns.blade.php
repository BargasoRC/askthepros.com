@component('email.header')
@endcomponent
<span class="text">
    <h3>SETUP SNS</h3>
    <br>
    Sent on {{$date}}.
    <br>
    <h5>data</h5>
    <p>
        {{$data}}
    </p>
    <br>
</span>
@component('email.footer')
@endcomponent
