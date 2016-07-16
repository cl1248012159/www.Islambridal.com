{{template config_path="design/email/header"}}
{{inlinecss file="email-inline.css"}}

<table class="main_body" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td class="action-content">
            <ul style="float: left;" class="new_nav">
                   <li class="first"><a   href="{{store url=""}}">Wedding Dress</a></li>
                   <li class="separate">•</li>
                   <li><a   href="{{store url=""}}">Wedding Dress</a></li>
                   <li class="separate">•</li>
                   <li><a   href="{{store url=""}}">Wedding Dress</a></li>
                   <li class="separate">•</li>
                   <li class="last"><a  href="{{store url=""}}">Wedding Dress</a></li>
           </ul>

           <p class="FL clear MT10">Dear  {{var customer.name}}!</p>

           <p class="FL clear MT10">Welcome to <span class="storeFrontendName">{{var store.getFrontendName()}}</span>!</p>

           <p class="FL clear MT10">The account you just registered will store both your personal and payment information securely, which will allow you to purchase items easily and safely at <span class="storeFrontendName">{{var store.getFrontendName()}}</span>.</p>

           <p class="FL clear MT10">Thanks a lot for your registration!</p>

           <p class="FL clear MT10">After your registration, you can order your favorite and newest fashion trends in wedding dresses, wedding party dresses, special occasion dresses and accessories at <span class="storeFrontendName">{{var store.getFrontendName()}}</span>. Choose your own chic fashion right away! Go shopping!</p>

           <p class="FL clear MT10">

            <a class="FL" href="http://www.JJsHouse.com/Wedding-Dresses-c2/" target="_blank" >
                <img src="http://d3piw3jndo3cpw.cloudfront.net/v5res/jjshouse/2016-01-11/images/common/reg_tpl/reg_tpl/en/1.png" border="0" style="width: 185px; height: 225px;">
            </a>

            <a class="FL" href="http://www.JJsHouse.com/Wedding-Dresses-c2/" target="_blank" >
                <img src="http://d3piw3jndo3cpw.cloudfront.net/v5res/jjshouse/2016-01-11/images/common/reg_tpl/reg_tpl/en/1.png" border="0" style="width: 185px; height: 225px;">
            </a>

            <a class="FL" href="http://www.JJsHouse.com/Wedding-Dresses-c2/" target="_blank" >
                <img src="http://d3piw3jndo3cpw.cloudfront.net/v5res/jjshouse/2016-01-11/images/common/reg_tpl/reg_tpl/en/1.png" border="0" style="width: 185px; height: 225px;">
            </a>

            <a class="FL" href="http://www.JJsHouse.com/Wedding-Dresses-c2/" target="_blank" >
                <img src="http://d3piw3jndo3cpw.cloudfront.net/v5res/jjshouse/2016-01-11/images/common/reg_tpl/reg_tpl/en/1.png" border="0" style="width: 185px; height: 225px;">
            </a>

            <a class="FL" href="http://www.JJsHouse.com/Wedding-Dresses-c2/" target="_blank" >
                <img src="http://d3piw3jndo3cpw.cloudfront.net/v5res/jjshouse/2016-01-11/images/common/reg_tpl/reg_tpl/en/1.png" border="0" style="width: 185px; height: 225px;">
            </a>

            <a class="FL" href="http://www.JJsHouse.com/Wedding-Dresses-c2/" target="_blank" >
                <img src="http://d3piw3jndo3cpw.cloudfront.net/v5res/jjshouse/2016-01-11/images/common/reg_tpl/reg_tpl/en/1.png" border="0" style="width: 185px; height: 225px;">
            </a>

            <a class="FL" href="http://www.JJsHouse.com/Wedding-Dresses-c2/" target="_blank" >
                <img src="http://d3piw3jndo3cpw.cloudfront.net/v5res/jjshouse/2016-01-11/images/common/reg_tpl/reg_tpl/en/1.png" border="0" style="width: 185px; height: 225px;">
            </a>

            <a class="FL" href="http://www.JJsHouse.com/Wedding-Dresses-c2/" target="_blank" >
                <img src="http://d3piw3jndo3cpw.cloudfront.net/v5res/jjshouse/2016-01-11/images/common/reg_tpl/reg_tpl/en/1.png" border="0" style="width: 185px; height: 225px;">
            </a>

            </p>

           <p class="FL clear MT10">Thanks again for choosing us. We hope you enjoy the shopping experience on <span class="storeFrontendName">{{var store.getFrontendName()}}</span>.</p>

           <p class="FL clear MT10">For further information or you have any other questions, please <a href="mailto:{{var store_email}}" class="contactus">Contact Us</a></p>

           <p class="FL clear MT10">Best regards,</p>

           <p class="FL clear MT10"> <span class="storeFrontendName">{{var store.getFrontendName()}}</span> Team</p>

            
        </td>
    </tr>
</table>