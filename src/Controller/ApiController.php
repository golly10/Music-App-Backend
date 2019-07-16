<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Customer;
use App\Entity\Employee;
use App\Entity\Genre;
use App\Entity\Invoice;
use App\Entity\Invoiceline;
use App\Entity\Mediatype;
use App\Entity\Playlist;
use App\Entity\Track;
use App\Entity\User;
use Doctrine\ORM\Query;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

/**
 * Class ApiController
 *
 * @Route("/api")
 */
class ApiController extends FOSRestController
{
    // Artists URLs
    /**
     * @Rest\Get("/artists", name="Artists", defaults={"_format":"json"})
     *
     */
    public function getArtists(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Artist::class)
            ->createQueryBuilder('c')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }

    /**
     * @Rest\Get("/artists/{id}", name="One Artists", defaults={"_format":"json"})
     *
     */
    public function getOneArtist($id): JsonResponse{

        $query = $this->getDoctrine()->getRepository(Artist::class)->createQueryBuilder('c')
            ->select('c.artistid', 'c.nameArtist')
            ->andWhere('c.artistid = :val')
            ->setParameter('val', $id)
            ->getQuery()
        ;

        $result = $query->getResult(Query::HYDRATE_ARRAY);
        return new JsonResponse($result);
    }

    /**
     * @Rest\Get("/artists/{id}/albums", name="One Artists Albums", defaults={"_format":"json"})
     *
     */
    public function getOneArtistAlbums($id): JsonResponse{

        $query = $this->getDoctrine()->getRepository(Album::class)->createQueryBuilder('c')
            ->select('c.albumid', 'c.nameAlbum')
            ->andWhere('c.artistid = :val')
            ->setParameter('val', $id)
            ->leftJoin('c.artistid', 'fc')
            ->addSelect('fc.nameArtist')
            ->orderBy('c.artistid', 'ASC')
            ->getQuery()
        ;

        $result = $query->getResult(Query::HYDRATE_ARRAY);
        return new JsonResponse($result);
    }

    /**
     * @Rest\Get("/artists/{id}/albums/{idA}", name="One Artists One Albums", defaults={"_format":"json"})
     *
     */
    public function getOneArtistOneAlbums($id, $idA): JsonResponse{

        $query = $this->getDoctrine()->getRepository(Album::class)->createQueryBuilder('c')
            ->select('c.albumid', 'c.nameAlbum')
            ->andWhere('c.albumid = :val')
            ->setParameter('val', $idA)
            ->andWhere('c.artistid = :val2')
            ->setParameter('val2', $id)
            ->leftJoin('c.artistid', 'fc')
            ->addSelect('fc.nameArtist')
            ->orderBy('c.artistid', 'ASC')
            ->getQuery()
        ;

        $result = $query->getResult(Query::HYDRATE_ARRAY);
        return new JsonResponse($result);
    }


    //Tracks URLs
    /**
     * @Rest\Get("/tracks", name="Tracks", defaults={"_format":"json"})
     *
     */
    public function getTracks(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Track::class)
            ->createQueryBuilder('c')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }

    /**
     * @Rest\Get("/tracks/{id}", name="One Track", defaults={"_format":"json"})
     *
     */
    public function getOneTrack($id): JsonResponse{

        $query = $this->getDoctrine()->getRepository(Track::class)->createQueryBuilder('c')
            ->select('c.trackid', 'c.nameTrack', 'c.composer', 'c.milliseconds', 'c.bytes', 'c.unitprice')
            ->andWhere('c.trackid = :val')
            ->setParameter('val', $id)

            ->leftJoin('c.albumid', 'fc')
            ->addSelect('fc.nameAlbum')

            ->leftJoin('fc.artistid', 'a')
            ->addSelect('a.nameArtist')

            ->leftJoin('c.mediatypeid', 'fm')
            ->addSelect('fm.nameMediatype')

            ->leftJoin('c.genreid', 'g')
            ->addSelect('g.nameGenre')

            ->orderBy('fc.nameAlbum', 'ASC')
            ->getQuery()
        ;

        $result = $query->getResult(Query::HYDRATE_ARRAY);
        return new JsonResponse($result);
    }



    // Albums URLs
    /**
     * @Rest\Get("/albums", name="Albums", defaults={"_format":"json"})
     *
     */
    public function getAlbums(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Album::class)
            ->createQueryBuilder('c')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }

    /**
     * @Rest\Get("/albums/{id}", name="One Album", defaults={"_format":"json"})
     *
     */
    public function getOneAlbum($id): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Album::class)->createQueryBuilder('c')
            ->select('c.albumid', 'c.nameAlbum')
            ->andWhere('c.albumid = :val')
            ->setParameter('val', $id)

            ->leftJoin('c.artistid', 'a')
            ->addSelect('a.nameArtist')
            ->getQuery()
        ;

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }

    /**
     * @Rest\Get("/albums/{id}/tracks", name="One Album Tacks", defaults={"_format":"json"})
     *
     */
    public function getOneAlbumTracks($id): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Track::class)->createQueryBuilder('c')
            ->select('c.trackid','c.nameTrack', 'c.composer')
            ->andWhere('c.albumid = :val')
            ->setParameter('val', $id)

            ->leftJoin('c.albumid', 'fc')
            ->addSelect('fc.nameAlbum')

            ->leftJoin('fc.artistid', 'a')
            ->addSelect('a.nameArtist')

            ->leftJoin('c.mediatypeid', 'm')
            ->addSelect('m.nameMediatype')

            ->leftJoin('c.genreid', 'g')
            ->addSelect('g.nameGenre')

            ->getQuery()
        ;

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }



    // Customers URLs
    /**
     * @Rest\Get("/customers", name="Customers", defaults={"_format":"json"})
     *
     */
    public function getCustomers(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Customer::class)
            ->createQueryBuilder('c')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }

    /**
     * @Rest\Get("/customers/{id}", name="One Customer", defaults={"_format":"json"})
     *
     */
    public function getOneCustomers($id): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Customer::class)
            ->createQueryBuilder('c')
            ->select('c.customerid','c.firstname', 'c.lastname', 'c.company', 'c.address', 'c.city', 'c.state', 'c.country', 'c.postalcode', 'c.phone', 'c.fax', 'c.email')
            ->andWhere('c.customerid = :val')
            ->setParameter('val', $id)
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }


    //Employees URLs
    /**
     * @Rest\Get("/employees", name="Employees", defaults={"_format":"json"})
     *
     */
    public function getEmployees(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Employee::class)
            ->createQueryBuilder('c')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }



    //Genre URLs
    /**
     * @Rest\Get("/genre", name="Genre", defaults={"_format":"json"})
     *
     */
    public function getGenre(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Genre::class)
            ->createQueryBuilder('c')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }


    //Invoice URLs
    /**
     * @Rest\Get("/invoice", name="Invoice", defaults={"_format":"json"})
     *
     */
    public function getInvoice(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Invoice::class)
            ->createQueryBuilder('c')
            ->select('c.billingcity', 'c.billingcountry', 'c.total')
            
            ->orderBy('c.billingcountry')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }



    //Invoicelines URLs
    /**
     * @Rest\Get("/invoicelines", name="Invoicelines", defaults={"_format":"json"})
     *
     */
    public function getInvoicelines(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Invoiceline::class)
            ->createQueryBuilder('c')
            ->select('c.invoicelineid')

            ->leftJoin('c.invoiceid', 'fc')
            ->addSelect('fc.total', 'fc.billingcountry')

            ->leftJoin('fc.customerid', 'cus')
            ->addSelect('cus.lastname')

            ->leftJoin('c.trackid', 't')
            ->addSelect('t.nameTrack')

            ->leftJoin('t.albumid', 'a')
            ->addSelect('a.nameAlbum')

            ->orderBy('c.invoicelineid', 'ASC')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }

    /**
     * @Rest\Get("/invoicelines/{id}", name="One Invoicelines", defaults={"_format":"json"})
     *
     */
    public function getOneInvoicelines($id): JsonResponse{

        $query = $this->getDoctrine()->getRepository(Invoiceline::class)
            ->createQueryBuilder('c')
            ->select('c.invoicelineid', 'c.unitprice', 'c.quantity')
            ->andWhere('c.invoicelineid = :val')
            ->setParameter('val', $id)

            ->leftJoin('c.invoiceid', 'fc')
            ->addSelect('fc.invoicedate', 'fc.billingaddress', 'fc.total')

            ->leftJoin('c.trackid', 't')
            ->addSelect('t.nameTrack')

            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }

    /**
     * @Rest\Get("/invoicelines/{id}/customer", name="One Invoicelines Customer", defaults={"_format":"json"})
     *
     */
    public function getOneInvoicelinesCustomer($id): JsonResponse{

        $query = $this->getDoctrine()->getRepository(Invoiceline::class)
            ->createQueryBuilder('c')
            ->select('c.invoicelineid')
            ->andWhere('c.invoicelineid = :val')
            ->setParameter('val', $id)

            ->leftJoin('c.invoiceid', 'fc')
            ->addSelect('fc.invoicedate', 'fc.total')

            ->leftJoin('c.trackid', 't')
            ->addSelect('t.nameTrack')

            ->leftJoin('fc.customerid', 'cus')
            ->addSelect('cus.customerid','cus.firstname', 'cus.lastname', 'cus.company', 'cus.address', 'cus.city', 'cus.state', 'cus.country', 'cus.postalcode', 'cus.phone', 'cus.fax', 'cus.email')

            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }


    //Mediatypes URLs
    /**
     * @Rest\Get("/mediatypes", name="Mediatypes", defaults={"_format":"json"})
     *
     */
    public function getMediatypes(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Mediatype::class)
            ->createQueryBuilder('c')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }



    //Playlists URLs
    /**
     * @Rest\Get("/playlists", name="Playlists", defaults={"_format":"json"})
     *
     */
    public function getPlaylists(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(Playlist::class)
            ->createQueryBuilder('c')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }



    //Users URLs
    /**
     * @Rest\Get("/users", name="Users", defaults={"_format":"json"})
     *
     */
    public function getUsers(): JsonResponse{
        $query = $this->getDoctrine()->getRepository(User::class)
            ->createQueryBuilder('c')
            ->getQuery();

        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return new JsonResponse($result);
    }
}
