<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use App\Entity\ProfilSortie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilsortieFixtures extends Fixture
{
   

    public const DEVELOPPER = 'DEVELOPPER';
    public const DESIGNER = 'DESIGNER';
    public const REFENCER = 'REFENCER';
    public const INTEGRATER = 'INTEGRATER';
    public const CODER = 'CODER';
    public const SCRAPPER = 'SCRAPPER';
    

    public function load(ObjectManager $manager)
    {
            
            $dev = new ProfilSortie();
            $dev->setLibelle(self::DEVELOPPER);
            $manager->persist($dev);
            
             
            $design = new ProfilSortie();
            $design->setLibelle(self::DESIGNER);
            $manager->persist($design);
            
            $ref = new ProfilSortie();
            $ref->setLibelle(self::REFENCER);
            $manager->persist($ref);

            $integra = new ProfilSortie();
            $integra->setLibelle(self::INTEGRATER);
            $manager->persist($integra);

            $coder = new ProfilSortie();
            $coder->setLibelle(self::CODER);
            $manager->persist($coder);
         
            $scrap= new ProfilSortie();
            $scrap->setLibelle(self::SCRAPPER);
            $manager->persist($scrap);

            $this->addReference(self::DEVELOPPER, $dev);    
            $this->addReference(self::DESIGNER, $design);
            $this->addReference(self::REFENCER, $ref); 
            $this->addReference(self::INTEGRATER, $integra);
            $this->addReference(self::CODER, $coder);
            $this->addReference(self::SCRAPPER, $scrap);
            $manager->flush();
    }
}