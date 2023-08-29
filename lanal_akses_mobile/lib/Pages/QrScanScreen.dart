import 'package:flutter/material.dart';
import 'package:iconify_flutter/iconify_flutter.dart';
import 'package:iconify_flutter/icons/mdi.dart';
import 'package:iconify_flutter/icons/ph.dart';
import 'package:lanal_akses_mobile/Pages/AbsensiManualScreen.dart';

import '../Themes/Theme.dart';
import '../Themes/Typography.dart';

class QrScanPages extends StatelessWidget {
  const QrScanPages({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppbarQr(),
      backgroundColor: mainTheme.backgroundColor,
      body: Column(
        children: [
          Padding(
            padding: EdgeInsets.only(right: 37, left: 37, top: 30),
            child: Column(
              children: [
                Container(
                  width: double.infinity,
                  child: Text(
                    'Selamat Datang',
                    style: mainTitle.copyWith(color: Colors.white),
                    textAlign: TextAlign.left,
                  ),
                ),
                SizedBox(
                  height: MediaQuery.of(context).size.height * 0.01,
                ),
                Center(
                  child: Image.asset(
                    'assets/images/image_qr_screen.png',
                    width: MediaQuery.of(context).size.width * 0.75,
                  ),
                ),
                SizedBox(
                  height: MediaQuery.of(context).size.height * 0.01,
                ),
                ElevatedButton(
                  onPressed: () {
                    Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) => const AbsensiManualPage()));
                  },
                  child: Row(
                    children: [
                      Text(
                        'Klik disini untuk absen tanpa scan QR',
                        style: mainButtonText,
                      ),
                      SizedBox(
                        width: 10,
                      ),
                      Iconify(
                        Mdi.clock,
                        color: Colors.white,
                        size: 18,
                      )
                    ],
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
      bottomNavigationBar: bottomAppBarContents(),
    );
  }
}

PreferredSizeWidget AppbarQr() {
  return AppBar(
    leading: Image.asset(
      'assets/images/logo_no_bg.png',
      scale: 5,
    ),
    title: Text.rich(
      TextSpan(
        text: 'Lanal '.toUpperCase(),
        style: mainTitle.copyWith(color: Colors.white, fontSize: 18),
        children: <InlineSpan>[
          TextSpan(
            text: 'Akses'.toUpperCase(),
            style: mainTitle.copyWith(
              color: mainTheme.colorScheme.onSecondary,
              fontSize: 18,
            ),
          )
        ],
      ),
    ),
  );
}

Widget bottomAppBarContents() {
  return Container(
    padding: EdgeInsets.only(top: 30),
    width: double.infinity,
    height: 150,
    decoration: BoxDecoration(
      color: Color(0xffE5FFFF),
      borderRadius: BorderRadius.only(
        topRight: Radius.circular(50.0),
        topLeft: Radius.circular(50.0),
      ),
    ),
    child: Column(
      children: [
        Text.rich(
          TextSpan(
              text: 'Scan untuk ',
              style:
                  mainTitle2.copyWith(color: mainTheme.colorScheme.secondary),
              children: [
                TextSpan(text: 'Absen sekarang', style: mainTitle2),
              ]),
        ),
        SizedBox(
          height: 12,
        ),
        ElevatedButton(
          style: ElevatedButton.styleFrom(
              padding: EdgeInsets.all(16),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.only(
                  topRight: Radius.circular(16.0),
                  topLeft: Radius.circular(16.0),
                  bottomRight: Radius.circular(16.0),
                  bottomLeft: Radius.circular(16.0),
                ),
              )),
          onPressed: () {},
          child: Iconify(
            Ph.camera_fill,
            color: Colors.white,
            size: 35,
          ),
        )
      ],
    ),
  );
}
