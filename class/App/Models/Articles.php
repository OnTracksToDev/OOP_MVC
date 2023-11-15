<?php

namespace App\Models;

use App\Models\AbstractTable;
use DateTime;

class Articles extends AbstractTable{

    private ?string $title = null;
    private ?string $content = null;
    private ?string $imagePath = null;
    private ?string $authorID = null;
    private ?DateTime $publicationDate = null;
    
}