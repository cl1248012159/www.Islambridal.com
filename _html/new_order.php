{{template config_path="design/email/header"}}
{{inlinecss file="email-inline.css"}}

<table class="main_body"  cellpadding="0" cellspacing="0" border="0">
<tr>
  <td class="action-content" colspan=2>
    <ul style="float: left;" class="new_nav">
      <li class="first"><a href="{{store url=""}}">Wedding Dress</a></li>
      <li class="separate">•</li>
      <li><a href="{{store url=""}}">Wedding Dress</a></li>
      <li class="separate">•</li>
      <li><a href="{{store url=""}}">Wedding Dress</a></li>
      <li class="separate">•</li>
      <li class="last"><a href="{{store url=""}}">Wedding Dress</a></li>
    </ul>
    <p class="FL clear MT10">
              Order No.{{var order.increment_id}}
              Order Date: {{var order.getCreatedAtFormated('long')}}
    </p>
    <p class="FL clear MT10">
      Dear {{htmlescape var=$order.getCustomerName()}}
    </p>
    <p class="FL clear MT10">
        Thank you for shopping on www.D-daydress.com! We have received your order.
      <br/>
        We will contact you in 24 hours to confirm the order detains with you,please keep in touch by email.
    </p>
    <p class="FL clear MT10">
        Thank you for shopping on www.D-daydress.com! We have received your order.
      <br/>
        We will contact you in 24 hours to confirm the order detains with you,please keep in touch by email.
    </p>


{{if order.getEmailCustomerNote()}}
            <table class="FL clear MT10" cellspacing="0" cellpadding="0" class="message-container">
                <tr>
                    <td>{{var order.getEmailCustomerNote()}}</td>
                </tr>
            </table>
            {{/if}}

    <table class="FL clear MT10" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td class="address-details">
                        <h6>Billing Information:</h6>
                        <p><span class="no-link">{{var order.getBillingAddress().format('html')}}</span></p>
                    </td>
                    {{depend order.getIsNotVirtual()}}
                    <td class="method-info">
                        <h6>Shipping method:</h6>
                        <p>{{var order.shipping_description}}</p>
                    </td>
                    {{/depend}}
                </tr>
            </table>

            {{layout handle="sales_email_order_items" order=$order}}



    <p class="FL clear MT10">
      Thanks again for the order at our site.Any other questions,pls email us.(<a href="mailto:{{var store_email}}">{{var store_email}}</a>)
    </p>

    <p class="FL clear MT10">
      Thanks and best regards
      <br/>
      <span class="storeFrontendName">{{var store.getFrontendName()}}</span>  Customer Service Center
    </p>

    <p class="FL clear MT10">
      Email:<a href="mailto:{{var store_email}}">{{var store_email}}</a>
      <br/>
      Website:{{store url=""}}
    </p>

  </td>
</tr>
</table>