@component('email.header')
@endcomponent
<span class="text">
  Hello Support,
  <br>
  <br>
</span>
<span class="text">
  You got a new message from {{$data['name']}} with the email of {{$data['email']}}:
  <br>
  <br>
  " {{$content}} "
  <br>
  <br>
</span>
<span class="text" style="text-align: center;">
  This is a system-generated email. Please do not reply.
</span>
@component('email.footer')
@endcomponent
<style>
.table thead{
    text-align: center;
}
</style>
