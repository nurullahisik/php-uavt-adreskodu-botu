# PHP ile uavt adres kodu botu

**İçerik**
1. [Adres Kodu Nedir](#what-is-uavt)
2. [Linkler](#links)
3. [Kurulum](#init)
4. [Kullanım](#usage)
5. [Veriler](#cities)
   1. [İller](#cities)
   2. [İlçeler](#district)
   3. [Bucak-Köy](#township_village)
   4. [Mahalle](#neighborhood)
   5. [Cadde-Sokak](#street)
   6. [Bina](#building)
   7. [İç Kapı](#door)
   8. [UAVT Kodundan Adres Getirme](#uavt)
   9. [Sorgu Sonucu](#result)

<a name="what-is-uavt"></a>
### Adres Kodu Nedir?
Adres kodu ülke sınırları içindeki tüm konutlara ait 10 haneli özel bir numaradır.

<a name="links"></a>
### Links

Adres kodu öğrenme sitesi (https://adreskodu.dask.gov.tr/)

<a name="init"></a>
### Kurulum
```
composer update
```

<a name="usage"></a>
### Kullanım
    <?php
        include __DIR__.'/vendor/autoload.php';
        
        use Dask\AdresKodu\AddressProperties;
        use Dask\AdresKodu\AddressInitialize;
        
        $object = new AddressInitialize();
        $object::init();
    ?>


<a name="cities"></a>
### İller
    <?php
        $properties = new AddressProperties();
        $properties->setId(0);
        $properties->setType("cities");
    ?>


<a name="district"></a>
### İlçeler
    <?php
        $properties = new AddressProperties();
        $properties->setId(1);
        $properties->setType("district");
    ?>


<a name="township_village"></a>
### Bucak-Köy
    <?php
        $properties = new AddressProperties();
        $properties->setId(1757);
        $properties->setType("township_village");
    ?>


<a name="neighborhood"></a>
### Mahalle
    <?php
        $properties = new AddressProperties();
        $properties->setId(65);
        $properties->setType("neighborhood");
    ?>


<a name="street"></a>
### Cadde-Sokak
    <?php
        $properties = new AddressProperties();
        $properties->setId(176887);
        $properties->setType("street");
    ?>


<a name="building"></a>
### Binalar
    <?php
        $properties = new AddressProperties();
        $properties->setId(496093);
        $properties->setType("building");
    ?>


<a name="door"></a>
### İç Kapı
    <?php
        $properties = new AddressProperties();
        $properties->setId(8122892);
        $properties->setType("door");
        
        print_r($object::create($properties)->getResult());
    ?>
    

<a name="uavt"></a>
### UAVT Kodundan adres getirme
    <?php
        $properties = new AddressProperties();
        $properties->setId(1315919009);
        $properties->setType("uavt");
    ?>
    
<a name="result"></a>
### Sorgu Sonucu
    <?php
        //result
        print_r($object::create($properties)->getResult());
    ?>



