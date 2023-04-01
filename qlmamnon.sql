-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 01, 2023 lúc 01:49 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlmamnon`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `anh`
--

CREATE TABLE `anh` (
  `MAGV` varchar(10) NOT NULL,
  `LINK` varchar(1000) NOT NULL,
  `CHUDE` varchar(1000) NOT NULL,
  `THOIGIAN` date NOT NULL,
  `DIADIEM` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `anh`
--

INSERT INTO `anh` (`MAGV`, `LINK`, `CHUDE`, `THOIGIAN`, `DIADIEM`) VALUES
('GV0', '../anhhoatdong/hbdt.jpg', 'Ngày hội bé đến trường', '2021-08-10', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/hbdt2.jpg', 'Ngày hội bé đến trường', '2021-08-10', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/hbdt3.jpg', 'Ngày hội bé đến trường', '2021-08-10', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/hbdt4.jpg', 'Ngày hội bé đến trường', '2022-08-10', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/hbdt5.jpg', 'Ngày hội bé đến trường', '2022-08-10', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/hbdt6.jpg', 'Ngày hội bé đến trường', '2022-08-10', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/xcvn1.jpg', 'Chương trình văn nghệ Xin chào Việt Nam', '2021-12-15', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/xcvn2.jpg', 'Chương trình văn nghệ Xin chào Việt Nam', '2021-12-15', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/xcvn3.jpg', 'Chương trình văn nghệ Xin chào Việt Nam', '2021-12-15', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/xcvn4.jpg', 'Chương trình văn nghệ Xin chào Việt Nam', '2021-12-15', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/xcvn5.jpg', 'Chương trình văn nghệ Xin chào Việt Nam', '2021-12-15', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/xcvn6.jpg', 'Chương trình văn nghệ Xin chào Việt Nam', '2021-12-15', 'Trường mầm non Mặt trời nhỏ'),
('GV0', '../anhhoatdong/xcvn7.jpg', 'Chương trình văn nghệ Xin chào Việt Nam', '2021-12-15', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl7.jpg', 'Halloween', '2022-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl8.jpg', 'Halloween', '2022-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl9.jpg', 'Halloween', '2022-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl10.jpg', 'Halloween', '2022-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl11.jpg', 'Halloween', '2022-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl12.jpg', 'Halloween', '2022-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl1.jpg', 'Halloween', '2021-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl2.jpg', 'Halloween', '2021-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl3.jpg', 'Halloween', '2021-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl4.jpg', 'Halloween', '2021-10-31', 'Trường mầm non Mặt trời nhỏ'),
('GV1', '../anhhoatdong/hl5.jpg', 'Halloween', '2021-10-31', 'Trường mầm non Mặt trời nhỏ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baidang`
--

CREATE TABLE `baidang` (
  `MABD` int(11) NOT NULL,
  `TIEUDE` varchar(1000) NOT NULL,
  `LINK` varchar(1000) NOT NULL,
  `THELOAI` varchar(30) NOT NULL,
  `MAGV` varchar(20) NOT NULL,
  `NGAYDANG` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `baidang`
--

INSERT INTO `baidang` (`MABD`, `TIEUDE`, `LINK`, `THELOAI`, `MAGV`, `NGAYDANG`) VALUES
(5, 'Thông báo tuyển sinh mầm non Mặt Trời Nhỏ 2022-2023', '../baidang/ThongBaoTuyenSinh2022-2023.pdf', 'Thông báo', 'GV0', '2022-09-20'),
(8, 'Biếng ăn ở trẻ em', '../baidang/Biếng ăn ở trẻ em_175981.pdf', 'Bài viết', 'GV1', '2022-09-28'),
(9, 'Thông báo khám sức khỏe', '../baidang/xet-nghiem-vi-chat-tai-nha-cho-tre.png', 'Thông báo', 'GV0', '2022-09-29'),
(11, 'Học cách chơi cùng bé', '../baidang/Học cách chơi cùng bé_415549.pdf', 'Bài viết', 'GV1', '2022-11-14'),
(12, 'Trẻ mầm non và sự khéo léo', '../baidang/Trẻ mầm non và sự khéo léo_804651.pdf', 'Bài viết', 'GV1', '2022-11-14'),
(14, 'Trẻ bỏ lớp mầm non đi luyện chữ', '../baidang/Trẻ bỏ lớp mầm non đi luyện chữ__714203.pdf', 'Bài viết', 'GV1', '2022-11-14'),
(16, 'Kế hoạch tổ chức chương trình văn nghệ Xin chào Việt Nam năm học 2022-2023', '../baidang/KHXCVN.pdf', 'Thông báo', 'GV0', '2022-11-16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuongtrinhhoc`
--

CREATE TABLE `chuongtrinhhoc` (
  `MACT` int(11) NOT NULL,
  `TIEUDE` varchar(200) NOT NULL,
  `LINK` varchar(1000) NOT NULL,
  `NAMHOC` varchar(10) NOT NULL,
  `MAKHOI` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chuongtrinhhoc`
--

INSERT INTO `chuongtrinhhoc` (`MACT`, `TIEUDE`, `LINK`, `NAMHOC`, `MAKHOI`) VALUES
(1, 'Chương trình học lớp mầm năm học 2022-2023', '../chuongtrinhhoc/CTH-MAM-2022-2023.pdf', '2022-2023', 'M'),
(2, 'Chương trình học lớp chồi năm học 2022-2023', '../chuongtrinhhoc/CTH-CHOI-2022-2023.pdf', '2022-2023', 'C'),
(4, 'Chương trình học lớp mầm năm học 2021-2022', '../chuongtrinhhoc/CTH-MAM-2021-2022.pdf', '2021-2022', 'M'),
(5, 'Chương trình học lớp chồi năm học 2021-2022', '../chuongtrinhhoc/CTH-CHOI-2021-2022.pdf', '2021-2022', 'C'),
(6, 'Chương trình học lớp lá năm học 2021-2022', '../chuongtrinhhoc/CTH-LA-2021-2022.pdf', '2021-2022', 'L');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gv`
--

CREATE TABLE `gv` (
  `MSGV` varchar(20) NOT NULL,
  `HOTENGV` varchar(50) NOT NULL,
  `NGAYSINH` date NOT NULL,
  `DIACHI` varchar(200) NOT NULL,
  `CMNDCCCD` varchar(12) NOT NULL,
  `SDT` varchar(15) NOT NULL,
  `NGAYVAOLAM` date NOT NULL,
  `TRINHDO` varchar(50) NOT NULL,
  `GIOITINH` varchar(5) NOT NULL,
  `TENDN` varchar(30) NOT NULL,
  `MATKHAU` varchar(20) NOT NULL,
  `ANHGV` varchar(1000) NOT NULL,
  `NANGKHIEU` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `gv`
--

INSERT INTO `gv` (`MSGV`, `HOTENGV`, `NGAYSINH`, `DIACHI`, `CMNDCCCD`, `SDT`, `NGAYVAOLAM`, `TRINHDO`, `GIOITINH`, `TENDN`, `MATKHAU`, `ANHGV`, `NANGKHIEU`) VALUES
('GV0', '', '0000-00-00', '', '', '', '0000-00-00', '', '', 'mnmattroinho', 'mnmattroinho123', '', ''),
('GV1', 'Trần Thị Thùy Dương', '1990-07-17', '3/2, Ninh Kiều, Cần Thơ', '123578921', '0304527132', '2021-06-05', 'Đại học', 'Nữ', 'thuyduong@123', 'nttduong12345', '../anhgv/glass+drum.jpg', 'Hát'),
('GV10', 'Trịnh thị Ngọc Trinh', '1985-10-12', 'Cần Thơ', '322899314', '9293847', '2007-04-15', 'Đại học', 'Nữ', '', 'Yi3Cgrsr', '', ''),
('GV11', 'Tô Thị Diễm', '1985-11-30', 'Cần Thơ', '24342433', '0928378575', '2010-05-30', 'Đại Học', 'Nữ', '', '0lYJH2VA', '', ''),
('GV13', 'Lương Thu Huyền', '1905-06-05', 'Cần Thơ', '345920385', '1239744', '1905-06-29', 'Đại học', 'Nữ', '', 'UxNa9M3M', '', ''),
('GV14', 'Đoàn Ánh Nguyệt', '1905-06-07', 'Cần Thơ', '342675988', '3892764', '1905-06-29', 'Đại học', 'Nữ', '', 'UxNa9M3M', '', ''),
('GV15', 'Lý Tố My', '1905-06-12', 'Ô Môn, Cần Thơ', '341247892', '312283874', '1905-07-05', 'Đại học', 'Nữ', '', 'UxNa9M3M', '', ''),
('GV16', 'Hồ Tuyết Ngọc', '1905-06-12', 'Bình Thủy, Cần Thơ', '325671234', '939199199', '1905-07-05', 'Đại học', 'Nữ', '', 'UxNa9M3M', '', ''),
('GV2', 'Trần Thị Kiều Phương', '1990-07-05', 'Ô Môn, Cần Thơ', '13243546', '0398451265', '2013-04-15', 'Đại Học', 'Nữ', 'ttkphuong123', 'ttkphuong123', '../anhgv/gv1.jpg', ''),
('GV3', 'Nguyễn Thị Tuyết', '1985-02-11', 'Bình Thủy, Cần Thơ', '32415478', '0293714456', '2008-04-15', 'Đại học', 'Nữ', 'nttuyet123', 'tuyet1234', '../anhgv/hoasen.jpg', ''),
('GV4', 'Trần Thị Mỹ Hồng', '1990-12-23', 'Bình Thủy, Cần Thơ', '32894658', '0917779348', '2013-04-15', 'Đại Học', 'Nữ', '', 'D7JdaJkA', '../anhgv/Hinhnendl.com---Hinh-nen-khong-gian (6).jpg', ''),
('GV5', 'Lê Thị Phương Nghi', '1980-02-15', 'Bình Thủy, Cần Thơ', '352467899', '0385462713', '2005-04-15', 'Đại Học', 'Nữ', '', 'y7qwsapT', '', ''),
('GV6', 'Đỗ Kim Thanh', '1983-09-17', 'Ô Môn, Cần Thơ', '323894231', '0753421693', '2007-04-15', 'Đại học', 'Nữ', '', '35QunsiD', '', ''),
('GV7', 'Phan Thị Ánh Nguyệt', '1985-04-25', 'Ô Môn, Cần Thơ', '378211233', '0762389761', '2007-04-15', 'Đại học', 'Nữ', '', 'E13ZJNcR', '', ''),
('GV8', 'Hồ Xuân Ánh', '1990-08-18', 'Ô Môn, Cần Thơ', '341247892', '37820193647', '2013-04-15', 'Đại học', 'Nữ', '', '', '', ''),
('GV9', 'Huỳnh Thị Mỹ Xuân', '1990-02-09', 'Bình Thủy, Cần Thơ', '325671234', '0394556123', '2013-04-15', 'Đại học', 'Nữ', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocsinh`
--

CREATE TABLE `hocsinh` (
  `MAHS` int(11) NOT NULL,
  `HOTENHS` varchar(50) NOT NULL,
  `NGAYSINH` date NOT NULL,
  `GIOITINH` varchar(5) NOT NULL,
  `DIACHI` varchar(200) NOT NULL,
  `NGAYNHAPHOC` date NOT NULL,
  `HOTENCHA` varchar(50) NOT NULL,
  `SDTCHA` varchar(15) NOT NULL,
  `HOTENME` varchar(50) NOT NULL,
  `SDTME` varchar(15) NOT NULL,
  `MSLOP` varchar(10) NOT NULL,
  `ANHHS` varchar(1000) NOT NULL,
  `ANHCHA` varchar(1000) NOT NULL,
  `ANHME` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hocsinh`
--

INSERT INTO `hocsinh` (`MAHS`, `HOTENHS`, `NGAYSINH`, `GIOITINH`, `DIACHI`, `NGAYNHAPHOC`, `HOTENCHA`, `SDTCHA`, `HOTENME`, `SDTME`, `MSLOP`, `ANHHS`, `ANHCHA`, `ANHME`) VALUES
(1, 'Trần Bảo Thiện', '2019-03-27', 'NAM', 'Nguyễn Văn Cừ, Ninh Kiều Cần Thơ', '2022-08-05', 'Trần Văn Thanh', '03829036', 'Nguyễn Thuý Loan', '024792002', 'C2', '../anhhs/be1.jpg', '../anhcha/cha1.jpg', '../anhme/me1.jpg'),
(4, 'Phương Thành Đông', '2019-04-11', 'Nam', '3/2, Ninh Kiều, Cần Thơ', '2022-08-05', 'Phương Thành Phú', '0939499599', 'Lê Cẩm Vân', '0949299199', 'M3', '../anhhs/images (4).jpg', '../anhcha/images (3).jpg', '../anhme/pngtree-shy-cartoon-mother-character-png-image_4692045.jpg'),
(5, 'Phan Hồng Ngân', '2019-02-04', 'Nữ', '3/2, Xuân Khánh, Ninh Kiều, Cần Thơ', '2022-08-05', 'Phan Tâm Toàn', '0288388488', 'Tô Thị Ngọc Diễm', '088588188', 'C2', '../anhhs/tải xuống (3).jpg', '../anhcha/images (6).jpg', '../anhme/images (7).jpg'),
(7, 'Võ Ngọc Diễm Trân', '2019-04-11', 'Nữ', 'Hưng Lợi, Ninh Kiều Cần Thơ', '2022-08-05', 'Võ Thành Long', '0919492329', 'Lê Thị Ngọc', '0399282381', 'M2', '../anhhs/tải xuống.jpg', '../anhcha/images (8).jpg', '../anhme/tải xuống (1).jpg'),
(15, 'Nguyễn Thành Nhân', '2019-03-06', 'Nam', 'Bình Thủy, Cần Thơ', '2022-08-05', 'Nguyễn Công Bằng', '0191211311', 'Nguyễn Thị Lan', '0911299199', 'M4', ' ', ' ', ' '),
(16, 'Trần Chí Phong', '2019-07-08', 'Nam', '', '2022-08-05', 'Trần Chí Huy', '011299322', 'Đoàn Ngọc Trúc', '', 'M3', ' ', ' ', ' '),
(17, 'Phạm Tuấn Anh', '2019-04-27', 'Nam', 'Mậu Thân, Ninh Kiều, Cần Thơ', '2022-08-05', 'Phạm Tuấn Vĩ', '0137284521', 'Nguyễn Kiều Thơ', '0943832673', 'M2', ' ', ' ', ' '),
(18, 'Phan Minh Hà', '2019-05-12', 'Nữ', 'Cần Thơ', '2022-08-05', 'Phan Văn Mạnh', '0969799199', 'Trần Thị Điệp', '0909231482', 'M4', '', '', ''),
(20, 'Võ Quốc Tường', '2019-01-03', 'Nam', 'Cần Thơ', '2022-08-05', 'Võ Thành Long', '092939393', 'Lê Xuân Đào', '0282823', 'M1', '', '', ''),
(21, 'Phan Ánh Tuyết', '2019-05-12', 'Nữ', 'Cần Thơ', '2022-08-05', 'Phan Mạnh Đạt', '', 'Trần Thị Ngọc', '', 'M2', '', '', ''),
(22, 'Nguyễn Chị Linh', '2019-06-15', 'Nam', 'Cần Thơ', '2022-08-05', 'Nguyễn Văn Minh', '', 'Nguyễn Thị Bích Tuyền', '', 'M2', '', '', ''),
(23, 'Võ Quốc Khởi', '2019-01-03', 'Nam', 'Cần Thơ', '2022-08-05', 'Võ Minh Sơn', '', 'Lê Thị Hồng Gấm', '', 'M2', '', '', ''),
(24, 'Trương Thị Thu Quyên', '2019-05-12', 'Nữ', 'Cần Thơ', '2022-08-05', 'Trương Minh Tân', '', 'Lý Thị Thu', '', 'C1', '', '', ''),
(33, 'Cao Đại Việt', '2019-05-12', 'Nam', 'Cần Thơ', '2022-08-05', 'Cao Thanh Tâm', '3298123', 'Trương Thu Hiền', '', 'M3', '', '', ''),
(36, 'Nguyễn Quy Tường', '2019-03-21', 'Nam', 'Cần Thơ', '2022-08-05', 'Nguyễn Thành Nhân', '933122333', 'Nguyễn Thi Út', '', 'M3', ' ', ' ', ' '),
(37, 'Hoàng Gia Khang', '2022-10-02', 'Nam', '', '2022-08-05', 'Hoàng Văn Khiêm', '909288377', 'Trần Ngọc Yến', '', 'M4', '', '', ''),
(38, 'Lê Trường Giang', '2019-09-18', 'Nam', '', '2022-08-05', 'Lê Văn Kiên', '', 'Trần Ngọc Yến', '', 'M4', '', '', ''),
(39, 'Phan Văn Thuận', '2019-01-04', 'Nam', 'Cần Thơ', '2022-08-06', 'Phan Văn Cường', '3938475', 'Nguyễn Thị Loan', '284747484', 'M2', ' ', ' ', ' '),
(44, 'Trần Thành Đạt', '1905-07-11', 'Nam', '3/2, Ninh Kiều, Cần Thơ', '1905-07-14', 'Trần Văn Thành', '0939499599', 'Nguyễn Thị Thu', '0949299199', 'M1', '', '', ''),
(45, 'Nguyễn Thanh Duy', '1905-07-11', 'Nam', 'Hưng Lợi, Ninh Kiều Cần Thơ', '1905-07-14', 'Nguyễn Quốc Toàn', '0919492329', 'Lê Thị Ngọc', '0399282381', 'M1', '', '', ''),
(46, 'Lê Văn Kiên', '1905-07-11', 'Nam', 'Cần Thơ', '1905-07-14', 'Lê Văn Long', '23384848', 'Lê Xuân Đào', '91234', 'M1', '', '', ''),
(47, 'Trần Ngọc Nữ', '1905-07-11', 'Nữ', 'Cần Thơ', '1905-07-14', 'Trần Văn Cường', '938333', 'Nguyễn Thị Loan', '9383748', 'M2', '', '', ''),
(48, 'Trương Thị Thanh Tuyền', '2018-05-23', 'Nữ', '', '0000-00-00', 'Trương Văn Lâm', '', 'Hồ Ngọc Điệp', '', 'C1', ' ', ' ', ' '),
(49, 'Phương Thành Nam', '2017-04-11', 'Nam', '3/2, Ninh Kiều, Cần Thơ', '2020-08-05', 'Phương Văn Cương', '0939499599', 'Lê Cẩm Vân', '0949299199', 'L1', '', '', ''),
(50, 'Trần Chí Cường', '2017-07-08', 'Nam', '', '2020-08-05', 'Trần Quốc Đại', '011299322', 'Đoàn Ngọc Trâm', '', 'L1', '', '', ''),
(51, 'Cao Quốc Tuấn', '2017-05-12', 'Nam', 'Cần Thơ', '2020-08-05', 'Cao Thanh Tâm', '03298123', 'Trương Thu Hường', '', 'L1', '', '', ''),
(52, 'Nguyễn Ngọc Thy', '2017-03-21', 'Nữ', 'Cần Thơ', '2020-08-05', 'Nguyễn Thành Nam', '933122333', 'Nguyễn Thi Đẹp', '', 'L1', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoi`
--

CREATE TABLE `khoi` (
  `MAKHOI` varchar(10) NOT NULL,
  `TENKHOI` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khoi`
--

INSERT INTO `khoi` (`MAKHOI`, `TENKHOI`) VALUES
('C', 'CHỒI'),
('L', 'LÁ'),
('M', 'MẦM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `MSLOP` varchar(10) NOT NULL,
  `TENLOP` varchar(30) NOT NULL,
  `MAKHOI` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`MSLOP`, `TENLOP`, `MAKHOI`) VALUES
('C1', 'Chồi 1', 'C'),
('C2', 'Chồi 2', 'C'),
('C3', 'Chồi 3', 'C'),
('L1', 'Lá 1', 'L'),
('L2', 'Lá 2', 'L'),
('L3', 'Lá 3', 'L'),
('M1', 'Mầm 1', 'M'),
('M2', 'Mầm 2', 'M'),
('M3', 'Mầm 3', 'M'),
('M4', 'Mầm 4', 'M');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanconggd`
--

CREATE TABLE `phanconggd` (
  `MAGV` varchar(10) NOT NULL,
  `MSLOP` varchar(10) NOT NULL,
  `NAMHOC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phanconggd`
--

INSERT INTO `phanconggd` (`MAGV`, `MSLOP`, `NAMHOC`) VALUES
('GV1', 'M2', '2021-2022'),
('GV2', 'M1', '2021-2022'),
('GV7', 'M3', '2021-2022'),
('GV3', 'M4', '2021-2022'),
('GV4', 'C1', '2021-2022'),
('GV9', 'C2', '2021-2022'),
('GV6', 'C3', '2021-2022'),
('GV2', 'L1', '2021-2022'),
('GV5', 'L2', '2021-2022'),
('GV10', 'C1', '2022-2023'),
('GV2', 'M2', '2022-2023'),
('GV15', 'L1', '2022-2023'),
('GV13', 'L3', '2022-2023'),
('GV1', 'M1', '2022-2023');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thucdon`
--

CREATE TABLE `thucdon` (
  `MATD` int(11) NOT NULL,
  `TIEUDE` varchar(200) NOT NULL,
  `LINK` varchar(1000) NOT NULL,
  `THANG` varchar(5) NOT NULL,
  `NAM` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thucdon`
--

INSERT INTO `thucdon` (`MATD`, `TIEUDE`, `LINK`, `THANG`, `NAM`) VALUES
(1, 'Thực đơn tháng 08 năm 2022', '../thucdon/TD-08-2022.pdf', '08', '2022-2023'),
(3, 'Thực đơn  tháng 08 năm 2021', '../thucdon/TD-08-2021.pdf', '08', '2021-2022'),
(4, 'Thực đơn tháng 09 năm  2022', '../thucdon/TD-09-2022.pdf', '09', '2022-2023'),
(5, 'Thực đơn tháng 09 năm 2021', '../thucdon/TD-09-2021.pdf', '09', '2021-2022'),
(6, 'Thực đơn tháng 10 năm 2021', '../thucdon/TD-10-2021.pdf', '10', '2021-2022'),
(7, 'Thực đơn tháng 11 năm 2021', '../thucdon/TD-11-2021.pdf', '11', '2021-2022'),
(8, 'Thực đơn tháng 10 năm 2022', '../thucdon/TD-10-2022.pdf', '10', '2022-2023');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `anh`
--
ALTER TABLE `anh`
  ADD KEY `gv-anh` (`MAGV`);

--
-- Chỉ mục cho bảng `baidang`
--
ALTER TABLE `baidang`
  ADD PRIMARY KEY (`MABD`),
  ADD KEY `gvdang` (`MAGV`);

--
-- Chỉ mục cho bảng `chuongtrinhhoc`
--
ALTER TABLE `chuongtrinhhoc`
  ADD PRIMARY KEY (`MACT`),
  ADD KEY `ctkhoi` (`MAKHOI`);

--
-- Chỉ mục cho bảng `gv`
--
ALTER TABLE `gv`
  ADD PRIMARY KEY (`MSGV`);

--
-- Chỉ mục cho bảng `hocsinh`
--
ALTER TABLE `hocsinh`
  ADD PRIMARY KEY (`MAHS`),
  ADD KEY `lop_hs` (`MSLOP`);

--
-- Chỉ mục cho bảng `khoi`
--
ALTER TABLE `khoi`
  ADD PRIMARY KEY (`MAKHOI`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`MSLOP`),
  ADD KEY `lopkhoi` (`MAKHOI`);

--
-- Chỉ mục cho bảng `phanconggd`
--
ALTER TABLE `phanconggd`
  ADD KEY `fkgv` (`MAGV`),
  ADD KEY `fklop` (`MSLOP`);

--
-- Chỉ mục cho bảng `thucdon`
--
ALTER TABLE `thucdon`
  ADD PRIMARY KEY (`MATD`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baidang`
--
ALTER TABLE `baidang`
  MODIFY `MABD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `chuongtrinhhoc`
--
ALTER TABLE `chuongtrinhhoc`
  MODIFY `MACT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `hocsinh`
--
ALTER TABLE `hocsinh`
  MODIFY `MAHS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `thucdon`
--
ALTER TABLE `thucdon`
  MODIFY `MATD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `anh`
--
ALTER TABLE `anh`
  ADD CONSTRAINT `gv-anh` FOREIGN KEY (`MAGV`) REFERENCES `gv` (`MSGV`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `baidang`
--
ALTER TABLE `baidang`
  ADD CONSTRAINT `gvdang` FOREIGN KEY (`MAGV`) REFERENCES `gv` (`MSGV`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `chuongtrinhhoc`
--
ALTER TABLE `chuongtrinhhoc`
  ADD CONSTRAINT `ctkhoi` FOREIGN KEY (`MAKHOI`) REFERENCES `khoi` (`MAKHOI`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `hocsinh`
--
ALTER TABLE `hocsinh`
  ADD CONSTRAINT `lop_hs` FOREIGN KEY (`MSLOP`) REFERENCES `lop` (`MSLOP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lopkhoi` FOREIGN KEY (`MAKHOI`) REFERENCES `khoi` (`MAKHOI`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `phanconggd`
--
ALTER TABLE `phanconggd`
  ADD CONSTRAINT `fkgv` FOREIGN KEY (`MAGV`) REFERENCES `gv` (`MSGV`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fklop` FOREIGN KEY (`MSLOP`) REFERENCES `lop` (`MSLOP`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
