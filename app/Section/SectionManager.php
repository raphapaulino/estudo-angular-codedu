<?php

namespace App\Section;

class SectionManager
{
    private $section = 'app'; // sessão padrão

    /**
     * Get the value of section
     * @return string
     */ 
    public function getSection(): string // null or Company
    {
        return $this->section;
    }

    /**
     * Set the value of section
     *
     * @return string $section
     */ 
    public function setSection(string $section): void
    {
        $this->section = $section;
    }

    public function get(string $key = null)
    {
        return $key ? config("sections.sections.{$this->section}.{$key}") : 
            config("sections.sections.{$this->section}");
    }
}