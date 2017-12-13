<?php

namespace COG\Recruiting\Validator;

use COG\Recruiting\Entity\Partner;
use COG\Recruiting\Validator\Rules\MaxChars;

class PartnerValidation
{

    /**
     * Validate Partner
     *
     * @param Partner $partner
     * @return array
     */
    public function validate(Partner $partner)
    {
        $maxChars = new MaxChars();
        $listMessage = array();

        $maxCharsName = $maxChars->check($partner->name, MAX_CHAR_NAME, MAX_CHAR_ERROR_NAME);
        $maxCharsHomePage = $maxChars->check($partner->homepage, MAX_CHAR_HOME_PAGE, MAX_CHAR_ERROR_HOME_PAGE);

        if ($maxCharsName !== true) {
            $listMessage['name'] = $maxCharsName;
        }

        if ($maxCharsHomePage !== true) {
            $listMessage['homepage'] = $maxCharsHomePage;
        }

        return $listMessage;
    }
}

