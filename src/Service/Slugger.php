<?php

namespace App\Service;


use Symfony\Component\String\Slugger\SluggerInterface;

class Slugger
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    /**
     * Return the slug of a string
     *
     * @param string $stringToSlugify The string will be turned into a slug
     * @return string
     */
    public function slugify(string $stringToSlugify): string
    {
        // return preg_replace('/\W+/', '-', strtolower($stringToSlugify));

        // On utilise maintenant le Slugger du composant String de Symfony
        return strtolower($this->slugger->slug($stringToSlugify));
    }

    /**
     * Create a slug for a post 
     *
     * @return void
     */
    public function slugifyPost($post)
    {
        $title = $post->getTitle();
        // On appelle slugify() plutot que de copier le code dans slugify
        $slug = $this->slugify($title);
        $post->setSlug($slug);
    }
}