/*
 Navicat Premium Data Transfer

 Source Server         : localhot
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : elearningsmp

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 29/01/2021 08:14:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for file_materi
-- ----------------------------
DROP TABLE IF EXISTS `file_materi`;
CREATE TABLE `file_materi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_kelas_id` int(11) NULL DEFAULT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of file_materi
-- ----------------------------
INSERT INTO `file_materi` VALUES (1, 1, 'uploads/file/BAB_III_-_12170075_SEPTU_PRANOWO_OUTLINE_PERANCANGAN_PROGRAM.docx');
INSERT INTO `file_materi` VALUES (2, 1, 'uploads/file/Siswa.pdf');

-- ----------------------------
-- Table structure for jawaban_essay
-- ----------------------------
DROP TABLE IF EXISTS `jawaban_essay`;
CREATE TABLE `jawaban_essay`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topik_tugas_id` int(11) NULL DEFAULT NULL,
  `id_quiz_essay` int(11) NULL DEFAULT NULL,
  `siswa_id` int(11) NULL DEFAULT NULL,
  `jawaban` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jawaban_essay
-- ----------------------------

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES (1, 'KELAS V');

-- ----------------------------
-- Table structure for kelas_siswa
-- ----------------------------
DROP TABLE IF EXISTS `kelas_siswa`;
CREATE TABLE `kelas_siswa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NULL DEFAULT NULL,
  `siswa_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kelas_siswa
-- ----------------------------
INSERT INTO `kelas_siswa` VALUES (1, 1, 1);

-- ----------------------------
-- Table structure for mapel
-- ----------------------------
DROP TABLE IF EXISTS `mapel`;
CREATE TABLE `mapel`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mapel
-- ----------------------------
INSERT INTO `mapel` VALUES (1, 'Matematika');

-- ----------------------------
-- Table structure for mapel_kelas
-- ----------------------------
DROP TABLE IF EXISTS `mapel_kelas`;
CREATE TABLE `mapel_kelas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NULL DEFAULT NULL,
  `mapel_id` int(11) NULL DEFAULT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pengajar_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mapel_kelas
-- ----------------------------
INSERT INTO `mapel_kelas` VALUES (1, 1, 1, 'senin', 2);

-- ----------------------------
-- Table structure for nilai
-- ----------------------------
DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siswa_id` int(11) NULL DEFAULT NULL,
  `topik_tugas_id` int(11) NULL DEFAULT NULL,
  `benar` int(11) NULL DEFAULT NULL,
  `salah` int(11) NULL DEFAULT NULL,
  `tidak_dikerjakan` int(11) NULL DEFAULT NULL,
  `persentase` int(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nilai
-- ----------------------------

-- ----------------------------
-- Table structure for nilai_essay
-- ----------------------------
DROP TABLE IF EXISTS `nilai_essay`;
CREATE TABLE `nilai_essay`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topik_tugas_id` int(11) NULL DEFAULT NULL,
  `siswa_id` int(11) NULL DEFAULT NULL,
  `nilai` int(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nilai_essay
-- ----------------------------
INSERT INTO `nilai_essay` VALUES (1, 3, 3, 12);
INSERT INTO `nilai_essay` VALUES (2, 5, 3, 10);

-- ----------------------------
-- Table structure for pengajar
-- ----------------------------
DROP TABLE IF EXISTS `pengajar`;
CREATE TABLE `pengajar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jk` int(1) NULL DEFAULT NULL COMMENT '1 = laki-laki, 0 = perempuan',
  `tempat_lahir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir` date NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `foto` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pengajar
-- ----------------------------
INSERT INTO `pengajar` VALUES (1, '123456', 'admin', 1, 'pontianaks', '2020-12-11', 'sui raya dalam', '');
INSERT INTO `pengajar` VALUES (2, '1256611', 'Afif', 1, 'Pontianak', '2021-01-26', 'Jln Sui Raya Dalam', 'uploads/Screenshot_4.png');

-- ----------------------------
-- Table structure for pengumuman
-- ----------------------------
DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE `pengumuman`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pengajar_id` int(11) NULL DEFAULT NULL,
  `mapel_kelas` int(11) NULL DEFAULT NULL,
  `tgl_dibuat` date NULL DEFAULT NULL,
  `tgl_berakhir` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengumuman
-- ----------------------------
INSERT INTO `pengumuman` VALUES (1, 'ABC', 2, 1, '2021-01-28', '2021-01-29');

-- ----------------------------
-- Table structure for quiz_essay
-- ----------------------------
DROP TABLE IF EXISTS `quiz_essay`;
CREATE TABLE `quiz_essay`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topik_tugas_id` int(11) NULL DEFAULT NULL,
  `pertanyaan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `gambar` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_dibuat` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of quiz_essay
-- ----------------------------

-- ----------------------------
-- Table structure for quiz_pilganda
-- ----------------------------
DROP TABLE IF EXISTS `quiz_pilganda`;
CREATE TABLE `quiz_pilganda`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topik_tugas_id` int(11) NULL DEFAULT NULL,
  `pertanyaan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pil_a` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pil_b` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pil_c` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pil_d` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kunci` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_dibuat` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of quiz_pilganda
-- ----------------------------

-- ----------------------------
-- Table structure for siswa
-- ----------------------------
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jk` int(1) NULL DEFAULT NULL COMMENT '1 = laki - laki, 0 = perempuan',
  `tempat_lahir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir` date NULL DEFAULT NULL,
  `agama` enum('islam','konghucu','kristen','protestan','yahudi') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tahun_masuk` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of siswa
-- ----------------------------
INSERT INTO `siswa` VALUES (1, '121313131', 'Afif', 1, 'Pontianak', '2021-01-26', 'islam', 'Jln Sungai Durian', '2019', 'uploads/Screenshot_16.png');

-- ----------------------------
-- Table structure for siswa_mengerjakan
-- ----------------------------
DROP TABLE IF EXISTS `siswa_mengerjakan`;
CREATE TABLE `siswa_mengerjakan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siswa_id` int(11) NULL DEFAULT NULL,
  `hits` tinyint(1) NULL DEFAULT NULL,
  `topik_tugas_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of siswa_mengerjakan
-- ----------------------------

-- ----------------------------
-- Table structure for topik_tugas
-- ----------------------------
DROP TABLE IF EXISTS `topik_tugas`;
CREATE TABLE `topik_tugas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mapel_kelas_id` int(11) NULL DEFAULT NULL,
  `tgl_dibuat` date NULL DEFAULT NULL,
  `waktu_pengerjaan` int(11) NULL DEFAULT NULL,
  `pengajar_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `terbit` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Y',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of topik_tugas
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_siswa` int(11) NULL DEFAULT NULL,
  `is_pengajar` int(11) NULL DEFAULT NULL,
  `is_admin` int(11) NULL DEFAULT NULL,
  `level` int(1) NULL DEFAULT NULL COMMENT '1 = admin, 2 = pengajar, 3 = siswa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, 1, 1, 1);
INSERT INTO `user` VALUES (2, 'afifarman50@gmail.com', 'e4f4aeac6558302cd355eae03cdbabd1', NULL, 2, NULL, 2);
INSERT INTO `user` VALUES (3, 'siswa@gmail.com', '3afa0d81296a4f17d477ec823261b1ec', 1, NULL, NULL, 3);

SET FOREIGN_KEY_CHECKS = 1;
