<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'page_title' => 'Terms of Use',
                'content' => '<p><strong>Last updated: August 10, 2019</strong></p>

                <p>These Terms and Conditions (&quot;Terms&quot;, &quot;Terms and Conditions&quot;) govern your relationship with <a href="http://avdopt.com/">AvDopt.com</a> website and the AvDopt mobile application (the &quot;Service&quot;) operated by Phpfoxy, LLC (&quot;us&quot;, &quot;we&quot;, or &quot;our&quot;). &quot;You&quot; and &quot;Your&quot; refers to you, the person accessing this website and compliant to the Service&rsquo;s terms and conditions.&nbsp;</p>

                <p>Please read these Terms and Conditions carefully before using the Service.</p>

                <p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>

                <p>By accessing or using the Service, you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service.</p>

                <h3><strong>Cookies</strong></h3>

                <p>We employ the use of cookies. By accessing AvDopt.com, you agreed to use cookies in agreement with the Phpfoxy, LLC&#39;s Privacy Policy.</p>

                <p>Most interactive websites use cookies to let us retrieve the user&rsquo;s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>

                <h3><strong>iFrames</strong></h3>

                <p>Without prior approval and written permission, you may not create frames around our Web Pages that alter in any way the visual presentation or appearance of our Website.</p>

                <h3><strong>Your Privacy</strong></h3>

                <p><strong>Please read our <a href="http://avdopt.com/policy">Privacy Policy</a></strong></p>

                <h3><strong>Content</strong></h3>

                <p>Our Service allows you to post, link, store, share and otherwise make available certain information, text, graphics, videos, or other material (&quot;Content&quot;). You are responsible for the Content that you post to the Service, including its legality, reliability, and appropriateness.</p>

                <p>By posting Content to the Service, you grant us the right and license to use, modify, publicly perform, publicly display, reproduce, and distribute such Content on and through the Service. You retain any and all of your rights to any Content you submit, post or display on or through the Service and you are responsible for protecting those rights. You agree that this license includes the right for us to make your Content available to other users of the Service, who may also use your Content subject to these Terms.</p>

                <p>You represent and warrant that: (i) the Content is yours (you own it) or you have the right to use it and grant us the rights and license as provided in these Terms, and (ii) the posting of your Content on or through the Service does not violate the privacy rights, publicity rights, copyrights, contract rights or any other rights of any person.</p>

                <h3><strong>Intellectual Property</strong></h3>

                <p>The Service and its original content (excluding Content provided by users), features and functionality are and will remain the exclusive property of Phpfoxy, LLC and its licensors. The Service is protected by copyright, trademark, and other laws of both the United States and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of Phpfoxy, LLC.</p>

                <p><strong>You must not:</strong></p>

                <ul>
                <li>
                <p>Republish material from AvDopt.com</p>
                </li>
                <li>
                <p>Sell, rent or sub-license material from AvDopt.com</p>
                </li>
                <li>
                <p>Reproduce, duplicate or copy material from AvDopt.com</p>
                </li>
                <li>
                <p>Redistribute content from AvDopt.com</p>
                </li>
                </ul>

                <p><strong>This Agreement shall begin on the date hereof.</strong></p>

                <p>You hereby grant Phpfoxy, LLC a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of Your Content in any and all forms, formats or media.</p>

                <h3><strong>Hyperlinking to our Content</strong></h3>

                <p><strong>The following organizations may link to our Website without prior written approval:</strong></p>

                <ul>
                <li>
                <p>Government agencies;</p>
                </li>
                <li>
                <p>Search engines;</p>
                </li>
                <li>
                <p>News organizations;</p>
                </li>
                <li>
                <p>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</p>
                </li>
                <li>
                <p>Systemwide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Website.</p>
                </li>
                </ul>

                <p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party&rsquo;s site.</p>

                <p><strong>We may consider and approve other link requests from the following types of organizations:</strong></p>

                <ul>
                <li>
                <p>commonly-known consumer and/or business information sources;</p>
                </li>
                <li>
                <p>dot.com community sites;</p>
                </li>
                <li>
                <p>associations or other groups representing charities;</p>
                </li>
                <li>
                <p>online directory distributors;</p>
                </li>
                <li>
                <p>internet portals;</p>
                </li>
                <li>
                <p>accounting, law and consulting firms; and</p>
                </li>
                <li>
                <p>educational institutions and trade associations.</p>
                </li>
                </ul>

                <p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Phpfoxy, LLC; and (d) the link is in the context of general resource information.</p>

                <p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party&rsquo;s site.</p>

                <p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Phpfoxy, LLC. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>

                <p><strong>Approved organizations may hyperlink to our Website as follows:</strong></p>

                <ul>
                <li>
                <p>By use of our corporate name; or</p>
                </li>
                <li>
                <p>By use of the uniform resource locator being linked to; or</p>
                </li>
                <li>
                <p>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party&rsquo;s site.</p>
                </li>
                </ul>

                <p>No use of Phpfoxy, LLC&#39;s logo or other artwork will be allowed for linking absent a trademark license agreement.</p>

                <h3><strong>Links To Other Websites</strong></h3>

                <p>Our Service may contain links to third-party web sites or services that are not owned or controlled by Phpfoxy, LLC.</p>

                <p>Phpfoxy, LLC has no control over and assumes no responsibility for, the content, privacy policies, or practices of any third-party web sites or services. You further acknowledge and agree that Phpfoxy, LLC shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>

                <h3><strong>Reservation of Rights</strong></h3>

                <p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amend these terms and conditions and it&rsquo;s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>

                <h3><strong>Removal of links from our website</strong></h3>

                <p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>

                <p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>

                <h3><strong>Accounts</strong></h3>

                <p>When you create an account with us, you must provide us with information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>

                <p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.</p>

                <p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>

                <p>You may not use as a username the name of another person or entity or that is not lawfully available for use, a name or trademark that is subject to any rights of another person or entity other than you without appropriate authorization, or a name that is otherwise offensive, vulgar or obscene.</p>

                <h3><strong>Termination</strong></h3>

                <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>

                <p>Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you may simply discontinue using the Service.</p>

                <p>We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>

                <h3><strong>Availability, Errors, and Inaccuracies</strong></h3>

                <p>We are constantly updating our offerings of products and services on the Service. The products or services available on our Service may be mispriced, described inaccurately, or unavailable, and we may experience delays in updating information on the Service and in our advertising on other web sites.</p>

                <p>We cannot and do not guarantee the accuracy or completeness of any information, including prices, product images, specifications, availability, and services. We reserve the right to change or update information and to correct errors, inaccuracies, or omissions at any time without prior notice.</p>

                <h3><strong>Contests, Sweepstakes, and Promotions</strong></h3>

                <p>Any contests, sweepstakes or other promotions (collectively, &quot;Promotions&quot;) made available through the Service may be governed by rules that are separate from these Terms. If you participate in any Promotions, please review the applicable rules as well as our Privacy Policy. If the rules for a Promotion conflict with these Terms, the Promotion rules will apply.</p>

                <h3><strong>Purchases</strong></h3>

                <p>If you wish to purchase any product or service made available through the Service (&quot;Purchase&quot;), you may be asked to supply certain information relevant to your Purchase including, without limitation, your credit card number, the expiration date of your credit card, your billing address, and your shipping information.</p>

                <p>You represent and warrant that: (i) you have the legal right to use any credit card(s) or other payment methods (s) in connection with any Purchase; and that (ii) the information you supply to us is true, correct and complete.</p>

                <p>By submitting such information, you grant us the right to provide the information to third parties for purposes of facilitating the completion of Purchases.</p>

                <h3><strong>Subscriptions</strong></h3>

                <p>Some parts of the Service are billed on a subscription basis (&quot;Subscription(s)&quot;). You will be billed in advance on a recurring and periodic basis (&quot;Billing Cycle&quot;). Billing cycles are set either on a monthly or annual basis, depending on the type of subscription plan you select when purchasing a Subscription.</p>

                <p>At the end of each Billing Cycle, your Subscription will automatically renew under the exact same conditions unless you cancel it or Phpfoxy, LLC cancels it. You may cancel your Subscription renewal either through your online account management page or by contacting Phpfoxy, LLC customer support team.</p>

                <p>A valid payment method, including credit card or PayPal, is required to process the payment for your Subscription. You shall provide Phpfoxy, LLC with accurate and complete billing information including full name, address, state, zip code, telephone number, and a valid payment method information. By submitting such payment information, you automatically authorize Phpfoxy, LLC to charge all Subscription fees incurred through your account to any such payment instruments.</p>

                <p>Should automatic billing fail to occur for any reason, Phpfoxy, LLC will issue an electronic invoice indicating that you must proceed manually, within a certain deadline date, with the full payment corresponding to the billing period as indicated on the invoice.</p>

                <h3><strong>Fee Changes</strong></h3>

                <p>Phpfoxy, LLC, in its sole discretion and at any time, may modify the Subscription fees for the Subscriptions. Any Subscription fee change will become effective at the end of the then-current Billing Cycle.</p>

                <p>Phpfoxy, LLC will provide you with reasonable prior notice of any change in Subscription fees to give you an opportunity to terminate your Subscription before such change becomes effective.</p>

                <p>Your continued use of the Service after the Subscription fee change comes into effect constitutes your agreement to pay the modified Subscription fee amount.</p>

                <h3><strong>Refunds</strong></h3>

                <p>Except when required by law, paid Subscription fees are non-refundable.</p>

                <h3><strong>Limitation Of Liability</strong></h3>

                <p>In no event shall Phpfoxy, LLC, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from (i) your access to or use of or inability to access or use the Service; (ii) any conduct or content of any third party on the Service; (iii) any content obtained from the Service; and (iv) unauthorized access, use or alteration of your transmissions or content, whether based on warranty, contract, tort (including negligence) or any other legal theory, whether or not we have been informed of the possibility of such damage, and even if a remedy set forth herein is found to have failed of its essential purpose.</p>

                <h3><strong>Disclaimer</strong></h3>

                <p>Your use of the Service is at your sole risk. The Service is provided on an &quot;AS IS&quot; and &quot;AS AVAILABLE&quot; basis. The Service is provided without warranties of any kind, whether expressed or implied, including, but not limited to, the implied warranty of merchantability, fitness for a particular purpose, non-infringement or course of performance.</p>

                <p>Phpfoxy, LLC and its subsidiaries, affiliates, and its licensors do not warrant that a) the Service will function uninterrupted, secure or available at any particular time or location; b) any errors or defects will be corrected; c) the Service is free of viruses or other harmful components; or d) the results of using the Service will meet your requirements.</p>

                <h3><strong>Governing Law</strong></h3>

                <p>These Terms shall be governed and construed in accordance with the laws of California, United States, without regard to its conflict of law provisions.</p>

                <p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>

                <h3><strong>Changes</strong></h3>

                <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is necessary we will provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

                <p>By continuing to access or use the Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>

                <h3><strong>Contact Us</strong></h3>

                <p>If you have any questions about this Privacy Policy, please contact us:</p>

                <ul>
                <li>
                <p>By visiting this page on our website: <a href="http://avdopt.com/contact">Contact Us</a></p>
                </li>
                <li>
                <p>By mail: PO BOX 9329, Ontario, California 91762, United States</p>
                </li>
                </ul>',
                'slug'=>'terms-of-us',
                'section'=> 'NONE',
                'column'=> '1'
            ],
            [
                'page_title' => 'Privacy Policy',
                'content' => '<p><strong>Effective date: October 6, 2019</strong></p>

                <p>Phpfoxy, LLC (&quot;us&quot;, &quot;we&quot;, or &quot;our&quot;) operates the <a href="http://avdopt.com/">Avdopt.com</a> website and the Avdopt mobile application (hereinafter referred to as the &quot;Service&quot;).</p>

                <p>This page informs you of our policies regarding the collection, use and disclosure of personal data when you use our Service and the choices you have associated with that data.</p>

                <p>We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, the terms used in this Privacy Policy have the same meanings as in our Terms and Conditions.</p>

                <h2><strong>Definitions</strong></h2>

                <ul>
                <li>
                <p>Service<br />
                Service means the http://www.avdopt.com website and the Avdopt mobile application operated by Phpfoxy, LLC</p>
                </li>
                <li>
                <p>Personal Data<br />
                Personal Data means data about a living individual who can be identified from those data (or from those and other information either in our possession or likely to come into our possession).</p>
                </li>
                <li>
                <p>Usage Data<br />
                Usage Data is data collected automatically either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</p>
                </li>
                <li>
                <p>Cookies<br />
                Cookies are small files stored on your device (computer or mobile device).</p>
                </li>
                </ul>

                <h2><strong>Information Collection and Use</strong></h2>

                <p>We collect several different types of information for various purposes to provide and improve our Service to you.</p>

                <h3><strong>Types of Data Collected</strong></h3>

                <p><strong><em>Personal Data</em></strong></p>

                <p>While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you (&quot;Personal Data&quot;). Personally identifiable information may include, but is not limited to:</p>

                <ul>
                <li>
                <p><strong>Email address</strong></p>
                </li>
                <li>
                <p><strong>Second Life legacy name</strong></p>
                </li>
                <li>
                <p><strong>UUID</strong></p>
                </li>
                <li>
                <p><strong>IP address</strong></p>
                </li>
                <li>
                <p><strong>Cookies and Usage Data</strong></p>
                </li>
                </ul>

                <p>We may use your Personal Data to contact you with newsletters, marketing or promotional materials and other information that may be of interest to you. You may opt out of receiving any, or all, of these communications from us by following the unsubscribe link or instructions provided in any email we send.</p>

                <p><em><strong>Usage Data</strong></em></p>

                <p>We may also collect information that your browser sends whenever you visit our Service or when you access the Service by or through a mobile device (&quot;Usage Data&quot;).</p>

                <p>This Usage Data may include information such as your computer&#39;s Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p>

                <p>When you access the Service with a mobile device, this Usage Data may include information such as the type of mobile device you use, your mobile device unique ID, the IP address of your mobile device, your mobile operating system, the type of mobile Internet browser you use, unique device identifiers and other diagnostic data.</p>

                <p><em><strong>Location Data</strong></em></p>

                <p>We may use and store information about your location if you give us permission to do so (&quot;Location Data&quot;). We use this data to provide features of our Service, to improve and customise our Service.</p>

                <p>You can enable or disable location services when you use our Service at any time by way of your device settings.</p>

                <p><em><strong>Tracking &amp; Cookies Data</strong></em></p>

                <p>We use cookies and similar tracking technologies to track the activity on our Service and we hold certain information.</p>

                <p>Cookies are files with a small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device. Other tracking technologies are also used such as beacons, tags and scripts to collect and track information and to improve and analyse our Service.</p>

                <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>

                <p><strong>Examples of Cookies we use:</strong></p>

                <ul>
                <li>
                <p>Session Cookies. We use Session Cookies to operate our Service.</p>
                </li>
                <li>
                <p>Preference Cookies. We use Preference Cookies to remember your preferences and various settings.</p>
                </li>
                <li>
                <p>Security Cookies. We use Security Cookies for security purposes.</p>
                </li>
                <li>
                <p>Advertising Cookies. Advertising Cookies are used to serve you with advertisements that may be relevant to you and your interests.</p>
                </li>
                </ul>

                <h2><strong>Use of Data</strong></h2>

                <p>Phpfoxy, LLC uses the collected data for various purposes:</p>

                <ul>
                <li>
                <p>To provide and maintain our Service</p>
                </li>
                <li>
                <p>To notify you about changes to our Service</p>
                </li>
                <li>
                <p>To allow you to participate in interactive features of our Service when you choose to do so</p>
                </li>
                <li>
                <p>To provide customer support</p>
                </li>
                <li>
                <p>To gather analysis or valuable information so that we can improve our Service</p>
                </li>
                <li>
                <p>To monitor the usage of our Service</p>
                </li>
                <li>
                <p>To detect, prevent and address technical issues</p>
                </li>
                <li>
                <p>To provide you with news, special offers and general information about other goods, services and events which we offer that are similar to those that you have already purchased or enquired about unless you have opted not to receive such information</p>
                </li>
                </ul>

                <h2><strong>Transfer of Data</strong></h2>

                <p>Your information, including Personal Data, may be transferred to &mdash; and maintained on &mdash; computers located outside of your state, province, country or other governmental jurisdiction where the data protection laws may differ from those of your jurisdiction.</p>

                <p>If you are located outside the United States and choose to provide information to us, please note that we transfer the data, including Personal Data, to United States and process it there.</p>

                <p>Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</p>

                <p>Phpfoxy, LLC will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy and no transfer of your Personal Data will take place to an organisation or a country unless there are adequate controls in place including the security of your data and other personal information.</p>

                <h2><strong>Disclosure of Data</strong></h2>

                <h3><em><strong>Business Transaction</strong></em></h3>

                <p>If Phpfoxy, LLC is involved in a merger, acquisition or asset sale, your Personal Data may be transferred. We will provide notice before your Personal Data is transferred and becomes subject to a different Privacy Policy.</p>

                <h3><em><strong>Disclosure for Law Enforcement</strong></em></h3>

                <p>Under certain circumstances, Phpfoxy, LLC may be required to disclose your Personal Data if required to do so by law or in response to valid requests by public authorities (e.g. a court or a government agency).</p>

                <h3><em><strong>Legal Requirements</strong></em></h3>

                <p>Phpfoxy, LLC may disclose your Personal Data in the good faith belief that such action is necessary to:</p>

                <ul>
                <li>
                <p>To comply with a legal obligation</p>
                </li>
                <li>
                <p>To protect and defend the rights or property of Phpfoxy, LLC</p>
                </li>
                <li>
                <p>To prevent or investigate possible wrongdoing in connection with the Service</p>
                </li>
                <li>
                <p>To protect the personal safety of users of the Service or the public</p>
                </li>
                <li>
                <p>To protect against legal liability</p>
                </li>
                </ul>

                <h2><strong>Security of Data</strong></h2>

                <p>The security of your data is important to us but remember that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>

                <h2><strong>Our Policy on &quot;Do Not Track&quot; Signals under the California Online Protection Act (CalOPPA)</strong></h2>

                <p>We do not support Do Not Track (&quot;DNT&quot;). Do Not Track is a preference you can set in your web browser to inform websites that you do not want to be tracked.</p>

                <p>You can enable or disable Do Not Track by visiting the Preferences or Settings page of your web browser.</p>

                <h2><strong>Service Providers</strong></h2>

                <p>We may employ third party companies and individuals to facilitate our Service (&quot;Service Providers&quot;), provide the Service on our behalf, perform Service-related services or assist us in analysing how our Service is used.</p>

                <p>These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>

                <h3><strong>Analytics</strong></h3>

                <p>We may use third-party Service Providers to monitor and analyse the use of our Service.</p>

                <ul>
                <li>
                <p>Google Analytics<br />
                Google Analytics is a web analytics service offered by Google that tracks and reports website traffic. Google uses the data collected to track and monitor the use of our Service. This data is shared with other Google services. Google may use the collected data to contextualise and personalise the ads of its own advertising network.<br />
                For more information on the privacy practices of Google, please visit the Google Privacy &amp; Terms web page: <a href="https://policies.google.com/privacy?hl=en">https://policies.google.com/privacy?hl=en</a></p>
                </li>
                </ul>

                <h3><strong>Advertising</strong></h3>

                <p>We may use third-party Service Providers to show advertisements to you to help support and maintain our Service.</p>

                <ul>
                <li>
                <p>Google AdSense &amp; DoubleClick Cookie<br />
                Google, as a third party vendor, uses cookies to serve ads on our Service. Google&#39;s use of the DoubleClick cookie enables it and its partners to serve ads to our users based on their visit to our Service or other websites on the Internet.<br />
                You may opt out of the use of the DoubleClick Cookie for interest-based advertising by visiting the Google Ads Settings web page: <a href="http://www.google.com/ads/preferences/">http://www.google.com/ads/preferences/</a></p>
                </li>
                <li>
                <p>Bing Ads<br />
                Bing Ads is an advertising service provided by Microsoft Inc.<br />
                You can opt-out from Bing Ads by following the instructions on Bing Ads Opt-out page: <a href="https://advertise.bingads.microsoft.com/en-us/resources/policies/personalized-ads">https://advertise.bingads.microsoft.com/en-us/resources/policies/personalized-ads</a><br />
                For more information about Bing Ads, please visit their Privacy Policy: <a href="https://privacy.microsoft.com/en-us/PrivacyStatement">https://privacy.microsoft.com/en-us/PrivacyStatement</a></p>
                </li>
                </ul>

                <h3><strong>Behavioral Remarketing</strong></h3>

                <p>Phpfoxy, LLC uses remarketing services to advertise on third party websites to you after you visited our Service. We and our third-party vendors use cookies to inform, optimise and serve ads based on your past visits to our Service.</p>

                <ul>
                <li>
                <p>Google Ads (AdWords)<br />
                Google Ads (AdWords) remarketing service is provided by Google Inc.<br />
                You can opt-out of Google Analytics for Display Advertising and customise the Google Display Network ads by visiting the Google Ads Settings page: <a href="http://www.google.com/settings/ads">http://www.google.com/settings/ads</a><br />
                Google also recommends installing the Google Analytics Opt-out Browser Add-on - <a href="https://tools.google.com/dlpage/gaoptout">https://tools.google.com/dlpage/gaoptout</a> - for your web browser. Google Analytics Opt-out Browser Add-on provides visitors with the ability to prevent their data from being collected and used by Google Analytics.<br />
                For more information on the privacy practices of Google, please visit the Google Privacy &amp; Terms web page: <a href="https://policies.google.com/privacy?hl=en">https://policies.google.com/privacy?hl=en</a></p>
                </li>
                <li>
                <p>Bing Ads Remarketing<br />
                Bing Ads remarketing service is provided by Microsoft Inc.<br />
                You can opt-out of Bing Ads interest-based ads by following their instructions: <a href="https://advertise.bingads.microsoft.com/en-us/resources/policies/personalized-ads">https://advertise.bingads.microsoft.com/en-us/resources/policies/personalized-ads</a><br />
                You can learn more about the privacy practices and policies of Microsoft by visiting their Privacy Policy page: <a href="https://privacy.microsoft.com/en-us/PrivacyStatement">https://privacy.microsoft.com/en-us/PrivacyStatement</a></p>
                </li>
                </ul>

                <h3><strong>Payments</strong></h3>

                <p>We may provide paid products and/or services within the Service. In that case, we use third-party services for payment processing (e.g. payment processors).</p>

                <p>We will not store or collect your payment card details. That information is provided directly to our third-party payment processors whose use of your personal information is governed by their Privacy Policy. These payment processors adhere to the standards set by PCI-DSS as managed by the PCI Security Standards Council, which is a joint effort of brands like Visa, MasterCard, American Express and Discover. PCI-DSS requirements help ensure the secure handling of payment information.</p>

                <p><strong>The payment processors we work with are:</strong></p>

                <ul>
                <li>
                <p>Apple Store In-App Payments<br />
                Their Privacy Policy can be viewed at <a href="https://www.apple.com/legal/privacy/en-ww/">https://www.apple.com/legal/privacy/en-ww/</a></p>
                </li>
                <li>
                <p>Google Play In-App Payments<br />
                Their Privacy Policy can be viewed at <a href="https://www.google.com/policies/privacy/">https://www.google.com/policies/privacy/</a></p>
                </li>
                <li>
                <p>Stripe<br />
                Their Privacy Policy can be viewed at <a href="https://stripe.com/us/privacy">https://stripe.com/us/privacy</a></p>
                </li>
                <li>
                <p>PayPal / Braintree<br />
                Their Privacy Policy can be viewed at <a href="https://www.paypal.com/webapps/mpp/ua/privacy-full">https://www.paypal.com/webapps/mpp/ua/privacy-full</a></p>
                </li>
                <li>
                <p>Authorize.net<br />
                Their Privacy Policy can be viewed at <a href="https://www.authorize.net/company/privacy/">https://www.authorize.net/company/privacy/</a></p>
                </li>
                <li>2Checkout</li>
                </ul>

                <p>Their Privacy Policy can be viewed at <a href="https://www.2checkout.com/policies/privacy-policy">https://www.2checkout.com/policies/privacy-policy</a></p>

                <ul>
                <li>
                <p>Square<br />
                Their Privacy Policy can be viewed at <a href="https://squareup.com/legal/privacy-no-account">https://squareup.com/legal/privacy-no-account</a></p>
                </li>
                </ul>

                <h2><strong>Links to Other Sites</strong></h2>

                <p>Our Service may contain links to other sites that are not operated by us. If you click a third party link, you will be directed to that third party&#39;s site. We strongly advise you to review the Privacy Policy of every site you visit.</p>

                <p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>

                <h2><strong>Children&#39;s Privacy</strong></h2>

                <p>Our Service does not address anyone under the age of 18 (&quot;Children&quot;).</p>

                <p>We do not knowingly collect personally identifiable information from anyone under the age of 18. If you are a parent or guardian and you are aware that your Child has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we take steps to remove that information from our servers.</p>

                <h2><strong>Changes to This Privacy Policy</strong></h2>

                <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>

                <p>We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update the &quot;effective date&quot; at the top of this Privacy Policy.</p>

                <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>

                <h2><strong>Contact Us</strong></h2>

                <p>If you have any questions about this Privacy Policy, please contact us:</p>

                <ul>
                <li>
                <p>By visiting this page on our website: <a href="http://avdopt.com/contact">Contact Us</a></p>
                </li>
                <li>
                <p>By mail: PO BOX 9329, Ontario, California 91762, United States</p>
                </li>
                </ul>',
                'slug'=>'privacy-policy',
                'column'=> '1'
            ]
        ];
        foreach($pages as $row){
            if(count(Page::where('page_title', $row['page_title'])->get()) <= 0){
                Page::create($row);
            }
        }
    }
}
