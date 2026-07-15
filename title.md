"TAMARAW: Trade and Market Access for Rural Agricultural Workers — A Farm-to-Table E-Commerce Platform with AI-Powered Farming Assistant for the Agricultural Communities of Baco, Oriental Mindoro"



protected function compile(string $content): string
{
    $content = $this->compileComments($content);
    $content = $this->compilePhp($content);        // ← dagdag dito
    $content = $this->compileLayout($content);
    // ...ang lahat ng iba pa
}

protected function compilePhp(string $content): string
{
    $content = preg_replace('/@php/', '<?php', $content);
    $content = preg_replace('/@endphp/', '?>', $content);
    return $content;
}