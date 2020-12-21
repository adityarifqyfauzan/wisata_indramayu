<?php

namespace Dialogflow\RichMessage;

class Card extends RichMessage
{
    /**
     * Enum for Dialogflow v1 text message object
     * https://dialogflow.com/docs/reference/agent/message-objects.
     */
    const v1MessageObjectCard = 1;

    /** @var string */
    protected $title;

    /** @var string */
    protected $text;

    /** @var string */
    protected $imageUrl;

    /** @var array */
    protected $buttons = [];

    /**
     * Create a new Card instance.
     *
     * @return Dialogflow\Response\Card
     */
    public static function create()
    {
        return new self();
    }

    /**
     * Set the title for a Card.
     *
     * @param string $title
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the text for a Card.
     *
     * @param string $text
     */
    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set the image for a Card.
     *
     * @param string $image image URL
     */
    public function image($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Set the button for a Card.
     *
     * @param string $buttonText button text
     * @param string $buttonUrl  button link URL
     */
    public function button($buttonText, $buttonUrl)
    {
        $this->buttons[] = [
            'buttonText' => $buttonText,
            'buttonUrl' =>  $buttonUrl,
        ];

        return $this;
    }

    /**
     * Render response as array for API V1.
     *
     * @return array
     */
    protected function renderV1()
    {
        if ('google' == $this->requestSource) {
            $out = [
                'type'     => 'basic_card',
                'platform' => $this->requestSource,
                'title'    => $this->title,
            ];

            if (! $this->text && ! $this->imageUrl) {
                $out['formattedText'] = ' '; // AoG requires text or image in card
            }

            if ($this->text) {
                $out['formattedText'] = $this->text;
            }

            if ($this->imageUrl) {
                $out['image'] = [
                    'url'               => $this->imageUrl,
                    'accessibilityText' => 'accessibility text',
                ];
            }

            if ($this->buttons) {
                $out['buttons'] = [];
                foreach ($this->buttons as $button) {
                    $out['buttons'][] =
                        [
                            'title'         => $button['buttonText'],
                            'openUrlAction' => [
                                'url' => $button['buttonUrl'],
                            ],
                        ];
                }
            }

            return $out;
        } else {
            $out = [
                'type'  => self::v1MessageObjectCard,
                'title' => $this->title,
            ];

            if ($this->text) {
                $out['subtitle'] = $this->text;
            }
            if ($this->imageUrl) {
                $out['imageUrl'] = $this->imageUrl;
            }

            // this is required in the response even if there are no buttons for some reason
            if ('slack' == $this->requestSource) {
                $out['buttons'] = [];
            }

            if ($this->buttons) {
                $out['buttons'] = [];
                foreach ($this->buttons as $button) {
                    $out['buttons'][] =
                        [
                            'text'     => $button['buttonText'],
                            'postback' => $button['buttonUrl'],
                        ];
                }
            }

            $out['platform'] = $this->requestSource;

            return $out;
        }
    }

    /**
     * Render response as array for API V2.
     *
     * @return array
     */
    protected function renderV2()
    {
        if ('google' == $this->requestSource) {
            $out = [
                'basicCard' => [
                    'title' => $this->title,
                ],
                'platform' => $this->v2PlatformMap[$this->requestSource],
            ];

            if ($this->text) {
                $out['basicCard']['formattedText'] = $this->text;
            }

            if ($this->imageUrl) {
                $out['basicCard']['image'] = [
                    'imageUri'          => $this->imageUrl,
                    'accessibilityText' => 'accessibility text',
                ];
            }

            if ($this->buttons) {
                $out['basicCard']['buttons'] = [];
                foreach ($this->buttons as $button) {
                    $out['basicCard']['buttons'][] =
                        [
                            'title'         => $button['buttonText'],
                            'openUriAction' => [
                                'uri' => $button['buttonUrl'],
                            ],
                        ];
                }
            }

            return $out;
        } else {
            $out = [
                'card' => [
                    'title' => $this->title,
                ],
                'platform' => $this->v2PlatformMap[$this->requestSource],
            ];

            if ($this->text) {
                $out['card']['subtitle'] = $this->text;
            }

            if ($this->imageUrl) {
                $out['card']['imageUri'] = $this->imageUrl;
            }

            if ($this->buttons) {
                $out['card']['buttons'] = [];
                foreach ($this->buttons as $button) {
                    $out['card']['buttons'][] =
                        [
                            'text'         => $button['buttonText'],
                            'postback' => $button['buttonUrl'],
                        ];
                }
            }

            return $out;
        }
    }
}
