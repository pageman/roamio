<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tag;
use Irazasyed\Telegram\Telegram;
use App\BeastResponse;

class BotCommand extends Command
{
    protected $categories = [
    [
        'category' => 'category',
        'nextCategory' => 0,
        'nextResponse' => 'What do you want to do?',
        'options' => [
            [
                'option' => '🍴 Food and Dining',
                'value' => 'Food and Dining',
                'response' => 'Must satisfy that craving, huh?',
            ],
            [
                'option' => '🎨 Art Appreciation',
                'value' => 'Art Appreciation',
                'response' => 'Feeling artsy!',
            ],
            [
                'option' => '👣 Outdoor Activities',
                'value' => 'Outdoor Activities',
                'response' => 'Adventures on the way!',
            ],
            [
                'option' => '✨ Nightlife',
                'value' => 'Nightlife',
                'response' => 'Get ready to party!',
            ],
            [
                'option' => '🏤 History and Landmark',
                'value' => 'History and Landmark',
                'response' => '',
            ],
            [
                'option' => '🎬 Theatre and Cinema',
                'value' => 'Theatre and Cinema',
                'response' => 'Witness awesome talent and performance!',
            ],
            [
                'option' => '💦 Water Activities',
                'value' => 'Water Activities',
                'response' => 'Prepare to get wet!',
            ],
            [
                'option' => '🏁 Fun and Games',
                'value' => 'Fun and Games',
                'response' => 'Exciting games await!',
            ],
            [
                'option' => '😅 I\'m not really sure',
                'value' => null,
                'response' => 'It\'s okay. 😉',
            ]
        ]
    ],
    [
        'category' => 'max.budget',
        'nextCategory' => 1,
        'nextResponse' => 'How much are you willing to spend?',
        'options' => [
            [
                'option' => '🙈 ₱0',
                'value' => 0,
                'response' => 'Happiness is a choice. 🙌',
            ],
            [
                'option' => '💰 ₱500',
                'value' => 500,
                'response' => 'Nice.',
            ],
            [
                'option' => '💸 ₱1000',
                'value' => 1000,
                'response' => 'Great!',
            ],
            [
                'option' => '₱5000',
                'value' => 5000,
                'response' => 'You deserve a break.',
            ],
            [
                'option' => '💎 ₱10000',
                'value' => 10000,
                'response' => 'Need some kind of escape?',
            ],
            [
                'option' => '😜 Don\'t care',
                'value' => null,
                'response' => 'Wow. Let me call your bank. 🏦 Jk.',
            ]
        ]
    ],
    [
        'category' => 'participants',
        'nextCategory' => 2,
        'nextResponse' => 'May I ask who you\'re spending time with? 😌',
        'options' => [
            [
                'option' => '👨‍👩‍👧‍👦 Family',
                'value' => 'Family',
                'response' => 'Happiness is a choice. 🙌',
            ],
            [
                'option' => '❤️ Date',
                'value' => 'Date',
                'response' => 'Nice.',
            ],
            [
                'option' => '👥 Friends',
                'value' => 'Group',
                'response' => 'Great!',
            ],
            [
                'option' => '🚶 I\'m going solo.',
                'value' => 'Solo',
                'response' => 'Nice!',
            ],
            [
                'option' => '😶 Not sure.',
                'value' => null,
                'response' => 'Wow. Let me call your bank. 🏦 Jk.',
            ]
        ]
    ]
];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:receive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $haha = 0;
           // while(true) {
                $telegram = new Telegram('112595027:AAHGhHF4_Bj5JiDYHEA-txtUaqe5JZXKnoY');
                $updates = $telegram->getUpdates();     
                $message_id = $updates[count($updates) - 1]["message"]["message_id"];
                $text = $updates[count($updates) - 1]["message"]["text"];
                $indb = BeastResponse::orderBy('id','desc')->first();
                $queryField = '';
                $nextResponse = '';
                $nextCategory = '';
                //new input
                if($message_id != $indb->description) {
                    //set latest input to new input

                    //traverse categories
                    for($i=0;$i<count($this->categories) - 1;$i++) {
                        $options = $this->categories[$i]['options'];
                        for($j=0;$j<count($options);$j++) {
                            $option = $options[$j];
                            //matched response
                            if($option["option"] == $text) {
                                $this->info("Pigay");
                                $nextResponse = $options[$j]['response'];
                                $queryValue = $options[$j]['value'];
                                break;
                            }
                        }

                        $queryField = $this->categories[$i + 1]['category'];
                        $nextResponse .= $this->categories[$i + 1]['nextResponse'];
                        $nextCategory = $this->categories[$this->categories[$i + 1]['nextCategory']];   
                        
                    }   
                        $keyboard = [];
                        $options = $nextCategory["options"];
                        for($i = 0; $i < count($options); ++ $i) {
                            $keyboard[] = [$options[$i]["option"]];
                        }
                        $reply_markup = $telegram->replyKeyboardMarkup($keyboard, true, true);
                        $response = $telegram->sendMessage('60554451', $nextResponse, false, null, $reply_markup);
                        $this->info(var_dump($text));
                        $indb->description = $message_id;
                        $indb->save();
                }
                //if new input
             //   usleep(1000000);
            //}
    }
}
