{{template config_path="design/email/header"}}
{{inlinecss file="email-inline.css"}}

<table class="main_body" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td class="action-content">
            

           <p class="FL clear MT10">Dear valued {{htmlescape var=$customer.name}}：</p>

           <p class="FL clear MT10">This email was sent automatically by Dresswe in response to your request to recover your password.</p>

           <p class="FL clear MT10">Please <a href="{{store url="customer/account/resetpassword/" _query_id=$customer.id _query_token=$customer.rp_token}}"><span>click here</span></a> to reset your password. If the link is invalid,you could copy and paste the following link {{store url="customer/account/resetpassword/" _query_id=$customer.id _query_token=$customer.rp_token}} into your browser directly and reset your password. </p>

           <p class="FL clear MT10">Any questions, please feel free to Contact Us:</p>

           <p class="FL clear MT10">If you did not forget your password, please ignore this email.</p>

           <p class="FL clear MT10">Best wishes,</p>

           <p class="FL clear MT10">D-daydress Customer Service Center</p>

           <p class="FL clear BB"></p>

           <p class="FL clear MT10">Email: <a href="mailto:{{var store_email}}">{{var store_email}}</a></p>

           <p class="FL clear MT10">Website: {{store url=""}}</p>

           <p class="FL clear MT10"><span class="storeFrontendName">{{var store.getFrontendName()}}</span> Team</p>
     
        </td>
    </tr>
</table>