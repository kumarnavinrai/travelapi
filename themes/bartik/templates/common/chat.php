<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?4JZGV2RD68BXHONRQVntinNoFtG81UbL";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");


$zopim(function() {
$zopim.livechat.setOnConnected(function() {
var department_status = $zopim.livechat.departments.getDepartment('Booking');

if( department_status.status=='online')
{
//$zopim.livechat.badge.show();
$zopim.livechat.badge.setColor('#2643a1');
$zopim.livechat.badge.setLayout('image_right');
$zopim.livechat.badge.setText('CHAT WITH Cheap Farez');
$zopim.livechat.badge.setImage('img/logo-invert.png');
$zopim.livechat.bubble.show();
$zopim.livechat.bubble.setText('Welcome To Cheap Farez Helpline!');
$zopim.livechat.window.setTitle('Cheap Farez Chat Helpline');
//$zopim.livechat.prechatForm.setGreetings('Thanks For Choosing Us!!');
$zopim.livechat.departments.setLabel('Cheap Farez Chat Helpline');
$zopim.livechat.setLanguage('en');
$zopim.livechat.theme.setColor('#2643a1');  
$zopim.livechat.concierge.setName('Live Chat With Cheap Farez');
$zopim.livechat.concierge.setAvatar('img/logo-invert.png');
$zopim.livechat.concierge.setTitle('Cheap Farez Chat Helpline');
//$zopim.livechat.departments.filter('');
$zopim.livechat.departments.setVisitorDepartment('Booking');
$zopim.livechat.theme.reload();
}
else
{
$zopim.livechat.hideAll();
}
});
});
</script>