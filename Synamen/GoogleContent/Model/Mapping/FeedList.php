<?php

namespace Synamen\GoogleContent\Model\Mapping;

use Magento\Framework\Data\OptionSourceInterface;

class FeedList implements OptionSourceInterface
{
    /**
     * Feed list
     *
     * @var array
     */
    public $feeds = [
        1 => 'Google'
    ];

    /**
     * @return array
     */
    public function toOptionArray()
    {
        foreach ($this->getFeeds() as $code => $label) {
            $options[$code] = [
                'label' => $label,
                'value' => $code
            ];
        }

        return $options;
    }

    /**
     * @return array|string[]
     */
    public function getFeeds()
    {
        return $this->feeds;
    }
}
