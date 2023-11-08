<?php
require_once "../../../connect.php";


if (isset($_GET['change'])) {
    $sql = "SELECT day FROM day2_day WHERE id = 1";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $currentDay = $row['day'];
        // Update day
        $newDay = $currentDay + 1;
        $sql = "UPDATE day2_day SET day = $newDay WHERE id = 1";
        if (mysqli_query($con, $sql)) {
            setcookie('berhasil_ganti', true, time() + 3600, '/');
            header('location: ../super_admin/index.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        // Tentuin pemenang bid
        $cekResultDay = "SELECT * FROM day2_bid WHERE result_day = $newDay";
        $result = mysqli_query($con, $cekResultDay);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idBid = $row['id'];
                $noBid = $row['no'];

                // Cek apakah jumlah bidders memenuhi
                $cekJumlahBidder = "SELECT COUNT(*) as jumlah_bidder FROM day2_kelompok_bid WHERE id_bid = $idBid";
                $biddersResult = mysqli_query($con, $cekJumlahBidder);
                if ($biddersResult) {
                    $biddersRow = mysqli_fetch_assoc($biddersResult);
                    $jumlahBidders = $biddersRow['jumlah_bidder'];

                    // Cek jumlah bidder memenuhi ngga
                    if ($jumlahBidders < $row['minimum_bidders']) {
                        // Kalau kurang dari minimum, isi winnernya pake kelompok dummy
                        $sql = "INSERT INTO day2_win (id_kelompok, no_bid, type) VALUES (-1, $noBid, 0)";
                        if (mysqli_query($con, $sql)) {
                            $sql = "INSERT INTO day2_news (day, judul, content) VALUES ($newDay, 'BID NO $noBid', 'TIDAK ADA PEMENANG')";
                            if (!mysqli_query($con, $sql)) {
                                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        }
                    } else {
                        // Cari winner
                        if ($jumlahBidders == 1) {
                            $cariWinner = "SELECT kb.id_kelompok 
                            FROM day2_kelompok_bid AS kb
                            WHERE kb.id_bid = $idBid";

                            $winnerResult = mysqli_query($con, $cariWinner);
                            if ($winnerResult) {
                                $winnerRow = mysqli_fetch_assoc($winnerResult);
                                $winnerKelompok = $winnerRow['id_kelompok'];

                                // Insert winner ke tabel win
                                $sql = "INSERT INTO day2_win (id_kelompok, no_bid, type) VALUES ($winnerKelompok, $noBid, 0)";
                                if (mysqli_query($con, $sql)) {
                                    $cariNama = "SELECT nama FROM day2_kelompok WHERE id = $winnerKelompok";
                                    $namaResult = mysqli_query($con, $cariNama);
                                    if ($namaResult) {
                                        $namaRow = mysqli_fetch_assoc($namaResult);
                                        $namaKelompok = $namaRow['nama'];
                                        // Insert winner ke tabel news
                                        $sql = "INSERT INTO day2_news (day, judul, content) VALUES ($newDay, 'PEMENANG BID NO $noBid', 'KELOMPOK $namaKelompok')";
                                        if (!mysqli_query($con, $sql)) {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                        }
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                    }
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                }
                            }
                        } else {
                            $cariWinner = "SELECT kb.id_kelompok, MIN(kb.harga) as min_harga
                            FROM day2_kelompok_bid AS kb
                            INNER JOIN day2_kelompok AS k ON kb.id_kelompok = k.id
                            WHERE kb.id_bid = $idBid AND k.sertifikasi = 1
                            GROUP BY kb.id_kelompok
                            HAVING min_harga = (SELECT MIN(harga) FROM day2_kelompok_bid WHERE id_bid = $idBid AND id_kelompok IN (SELECT id FROM day2_kelompok WHERE sertifikasi = 1))
                            ORDER BY (SELECT timestamp FROM day2_kelompok_bid WHERE id_bid = $idBid AND id_kelompok = kb.id_kelompok LIMIT 1)
                            LIMIT 1";

                            $winnerResult = mysqli_query($con, $cariWinner);
                            if ($winnerResult) {
                                $winnerRow = mysqli_fetch_assoc($winnerResult);

                                if ($winnerRow) {
                                    $winnerKelompok = $winnerRow['id_kelompok'];

                                    // Insert winner ke tabel win
                                    $sql = "INSERT INTO day2_win (id_kelompok, no_bid, type) VALUES ($winnerKelompok, $noBid, 0)";
                                    if (mysqli_query($con, $sql)) {
                                        $cariNama = "SELECT nama FROM day2_kelompok WHERE id = $winnerKelompok";
                                        $namaResult = mysqli_query($con, $cariNama);
                                        if ($namaResult) {
                                            $namaRow = mysqli_fetch_assoc($namaResult);
                                            $namaKelompok = $namaRow['nama'];
                                            // Insert winner ke tabel news
                                            $sql = "INSERT INTO day2_news (day, judul, content) VALUES ($newDay, 'PEMENANG BID NO $noBid', 'KELOMPOK $namaKelompok')";
                                            if (!mysqli_query($con, $sql)) {
                                                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                            }
                                        } else {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                        }
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                    }
                                } else {
                                    $cariWinner = "SELECT kb.id_kelompok, MIN(kb.harga) as min_harga
                                    FROM day2_kelompok_bid AS kb
                                    INNER JOIN day2_kelompok AS k ON kb.id_kelompok = k.id
                                    WHERE kb.id_bid = $idBid
                                    GROUP BY kb.id_kelompok
                                    HAVING min_harga = (SELECT MIN(harga) FROM day2_kelompok_bid WHERE id_bid = $idBid AND id_kelompok IN (SELECT id FROM day2_kelompok))
                                    ORDER BY (SELECT timestamp FROM day2_kelompok_bid WHERE id_bid = $idBid AND id_kelompok = kb.id_kelompok LIMIT 1)
                                    LIMIT 1";

                                    $winnerResult = mysqli_query($con, $cariWinner);
                                    if ($winnerResult) {
                                        $winnerRow = mysqli_fetch_assoc($winnerResult);
                                        $winnerKelompok = $winnerRow['id_kelompok'];

                                        // Insert winner ke tabel win
                                        $sql = "INSERT INTO day2_win (id_kelompok, no_bid, type) VALUES ($winnerKelompok, $noBid, 0)";
                                        if (mysqli_query($con, $sql)) {
                                            $cariNama = "SELECT nama FROM day2_kelompok WHERE id = $winnerKelompok";
                                            $namaResult = mysqli_query($con, $cariNama);
                                            if ($namaResult) {
                                                $namaRow = mysqli_fetch_assoc($namaResult);
                                                $namaKelompok = $namaRow['nama'];
                                                // Insert winner ke tabel news
                                                $sql = "INSERT INTO day2_news (day, judul, content) VALUES ($newDay, 'PEMENANG BID NO $noBid', 'KELOMPOK $namaKelompok')";
                                                if (!mysqli_query($con, $sql)) {
                                                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                                }
                                            } else {
                                                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                            }
                                        } else {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        // =======================================================================================================================

        // Tentuin pemenang fixed
        $cekResultDay = "SELECT * FROM day2_fixed WHERE result_day = $newDay";
        $result = mysqli_query($con, $cekResultDay);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idFixed = $row['id'];
                $noFixed = $row['no'];

                // Cek apakah jumlah bidders memenuhi
                $cekJumlahBidder = "SELECT COUNT(*) as jumlah_bidder FROM day2_kelompok_fixed WHERE id_fixed = $idFixed";
                $biddersResult = mysqli_query($con, $cekJumlahBidder);
                if ($biddersResult) {
                    $biddersRow = mysqli_fetch_assoc($biddersResult);
                    $jumlahBidders = $biddersRow['jumlah_bidder'];

                    // Cek jumlah bidder memenuhi ngga
                    if ($jumlahBidders < 1) {
                        // Kalau kurang dari minimum, isi winnernya pake kelompok dummy
                        $sql = "INSERT INTO day2_win (id_kelompok, no_bid, type) VALUES (-1, $noFixed,1)";
                        if (mysqli_query($con, $sql)) {
                            $sql = "INSERT INTO day2_news (day, judul, content) VALUES ($newDay, 'FIXED NO $noFixed', 'TIDAK ADA PEMENANG')";
                            if (!mysqli_query($con, $sql)) {
                                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        }
                    } else {
                        // Cari winner
                        if ($jumlahBidders == 1) {
                            $cariWinner = "SELECT kf.id_kelompok 
                            FROM day2_kelompok_fixed AS kf
                            WHERE kf.id_fixed = $idFixed";

                            $winnerResult = mysqli_query($con, $cariWinner);
                            if ($winnerResult) {
                                $winnerRow = mysqli_fetch_assoc($winnerResult);
                                $winnerKelompok = $winnerRow['id_kelompok'];

                                // Insert winner ke tabel win
                                $sql = "INSERT INTO day2_win (id_kelompok, no_bid, type) VALUES ($winnerKelompok, $noFixed, 1)";
                                if (mysqli_query($con, $sql)) {
                                    $cariNama = "SELECT nama FROM day2_kelompok WHERE id = $winnerKelompok";
                                    $namaResult = mysqli_query($con, $cariNama);
                                    if ($namaResult) {
                                        $namaRow = mysqli_fetch_assoc($namaResult);
                                        $namaKelompok = $namaRow['nama'];
                                        // Insert winner ke tabel news
                                        $sql = "INSERT INTO day2_news (day, judul, content) VALUES ($newDay, 'PEMENANG FIXED NO $noFixed', 'KELOMPOK $namaKelompok')";
                                        if (!mysqli_query($con, $sql)) {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                        }
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                    }
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                }
                            }
                        } else {
                            $cariWinner = "SELECT kf.id_kelompok
                            FROM day2_kelompok_fixed AS kf
                            INNER JOIN day2_kelompok AS k ON kf.id_kelompok = k.id
                            WHERE kf.id_fixed = $idFixed AND k.sertifikasi = 1
                            ORDER BY (SELECT timestamp FROM day2_kelompok_fixed WHERE id_fixed = $idFixed AND id_kelompok = kf.id_kelompok LIMIT 1)
                            LIMIT 1";

                            $winnerResult = mysqli_query($con, $cariWinner);
                            if ($winnerResult) {
                                $winnerRow = mysqli_fetch_assoc($winnerResult);

                                if ($winnerRow) {
                                    $winnerKelompok = $winnerRow['id_kelompok'];

                                    // Insert winner ke tabel win
                                    $sql = "INSERT INTO day2_win (id_kelompok, no_bid, type) VALUES ($winnerKelompok, $noFixed, 1)";
                                    if (mysqli_query($con, $sql)) {
                                        $cariNama = "SELECT nama FROM day2_kelompok WHERE id = $winnerKelompok";
                                        $namaResult = mysqli_query($con, $cariNama);
                                        if ($namaResult) {
                                            $namaRow = mysqli_fetch_assoc($namaResult);
                                            $namaKelompok = $namaRow['nama'];
                                            // Insert winner ke tabel news
                                            $sql = "INSERT INTO day2_news (day, judul, content) VALUES ($newDay, 'PEMENANG FIXED NO $noFixed', 'KELOMPOK $namaKelompok')";
                                            if (!mysqli_query($con, $sql)) {
                                                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                            }
                                        } else {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                        }
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                    }
                                } else {
                                    $cariWinner = "SELECT kf.id_kelompok
                                    FROM day2_kelompok_fixed AS kf
                                    INNER JOIN day2_kelompok AS k ON kf.id_kelompok = k.id
                                    WHERE kf.id_fixed = $idFixed
                                    ORDER BY (SELECT timestamp FROM day2_kelompok_fixed WHERE id_fixed = $idFixed AND id_kelompok = kf.id_kelompok LIMIT 1)
                                    LIMIT 1";

                                    $winnerResult = mysqli_query($con, $cariWinner);
                                    if ($winnerResult) {
                                        $winnerRow = mysqli_fetch_assoc($winnerResult);
                                        $winnerKelompok = $winnerRow['id_kelompok'];
                                        // Insert winner ke tabel win
                                        $sql = "INSERT INTO day2_win (id_kelompok, no_bid, type) VALUES ($winnerKelompok, $noFixed, 1)";
                                        if (mysqli_query($con, $sql)) {
                                            $cariNama = "SELECT nama FROM day2_kelompok WHERE id = $winnerKelompok";
                                            $namaResult = mysqli_query($con, $cariNama);
                                            if ($namaResult) {
                                                $namaRow = mysqli_fetch_assoc($namaResult);
                                                $namaKelompok = $namaRow['nama'];
                                                // Insert winner ke tabel news
                                                $sql = "INSERT INTO day2_news (day, judul, content) VALUES ($newDay, 'PEMENANG FIXED NO $noFixed', 'KELOMPOK $namaKelompok')";
                                                if (!mysqli_query($con, $sql)) {
                                                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                                }
                                            } else {
                                                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                            }
                                        } else {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        // =====================================================================================


    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

$success = '';
if (isset($_COOKIE['berhasil_ganti'])) {
    setcookie('berhasil_ganti', null, time() - 3600, '/');
    $success = "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Hari sudah terganti!',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                })
            </script>";
}
?>