<?php

use Illuminate\Database\Seeder;
use App\Faq;
class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'question'=>'What is AvDopt?',
                'answer'=>'AvDopt is a platform which enables Second Life Avatars to conveniently adopt other Avatars.'
            ],
            [
                'question'=>'Is AvDopt affiliated with Linden Labs?',
                'answer'=>'No, AvDopt is in no way affiliated with Second Life, nor Linden Labs.'
            ],
            [
                'question'=>'Do you offer Refunds?',
                'answer'=>'No, except when required by law, paid subscription fees are non-refundable.'
            ],
            [
                'question'=>'What are Tokens?',
                'answer'=>'AvDopt Tokens are our virtual currency and is only used to make payment on AvDopt.com. Tokens cannot be bought nor sold outside of the AvDopt platform.'
            ],
            [
                'question'=>'What’s the value of a Token?',
                'answer'=>'1 USD = 255 Tokens\r\n1 Linden = 1 Token'
            ],
            [
                'question'=>'How do I buy Tokens?',
                'answer'=>'There are two ways to buy Tokens. \r\n1: Go to your Dashboard, click “Deposit” button, enter the amount you’d like to add to your wallet and follow the instructions. Locate a terminal In-World & pay it the amount you entered.\r\n2: Visit an AvDopt terminal In-World and pay it. Tokens will be added to your wallet.'
            ],
            [
                'question'=>'How do I register for AvDopt?',
                'answer'=>'Simply locate an AvDopt terminal In-World, touch it, select new registration, create a password and the rest is self explanatory on the website account setup page.'
            ],
            [
                'question'=>'Do I have to pay to use AvDopt?',
                'answer'=>'No! AvDopt is absolutely free to join and use. However, we also offer affordable premium plans for members wanting to experience more features.'
            ],
            [
                'question'=>'Where are the  adoption panels In-World?',
                'answer'=>'No. Our methods of matching are 100% web-based; thus, panels are a thing of the past.'
            ],
            [
                'question'=>'Is AvDopt affiliated with other adoption agencies?',
                'answer'=>'Though we\'d love to be, it’s a conflict of interest. Therefore, AvDopt is not affiliated with any adoption agencies in Second Life.'
            ],
            [
                'question'=>'What is a Family Role?',
                'answer'=>'Family Role is the role which a member plays in a family. On AvDopt Family Roles are used to identify, promote and match users.'
            ],
            [
                'question'=>'What are User Groups?',
                'answer'=>'User Groups are used to categorise members on the AvDopt platform.'
            ],
            [
                'question'=>'How does trials work?',
                'answer'=>'AvDopt members are 100% in control of "Trial Dates". After a successful match, members may schedule a Trial Date and invite their match. The match will then decide if they’ll accept the invite or not. Members may skip the trial process and hop into a chat session and choose to adopt right away if they wanted.'
            ],
            [
                'question'=>'Is AvDopt hiring?',
                'answer'=>'We\'re always conducting interviews and placing employees. To view available job positions visit http://www.avdopt.com/jobs'
            ],
            [
                'question'=>'How do I volunteer at AvDopt?',
                'answer'=>'Volunteers are always welcome.'
            ],
            [
                'question'=>'How do I volunteer at AvDopt?',
                'answer'=>'Volunteers are always welcome.'
            ],
            [
                'question'=>'What makes AvDopt the "A" in Adoption?',
                'answer'=>'AvDopt is unique, innovative, reliable, and revolutionary. We deliver only the best to our members; therefore, it’s them that gives us the “A” in Adoption.'
            ],
            [
                'question'=>'What\'s on the AvDopt Sim?',
                'answer'=>'The entire AvDopt region is recreational; boasting kids clubhouse, playground, parks, beaches, forests, and more. Our two other sims are also right next door: Monday Estates & Unites Estates.'
            ],
            [
                'question'=>'I need help who do I contact?',
                'answer'=>'We advise that you create a support ticket. All tickets are addressed within 24 - 48 hours. You may also visit our In-World Center for live support.'
            ]            
        ];
    }
}
