import 'package:flutter/material.dart';
import 'package:iconify_flutter/iconify_flutter.dart';
import 'package:iconify_flutter/icons/ep.dart';
import 'package:lanal_akses_mobile/Pages/QrScanScreen.dart';
import 'package:lanal_akses_mobile/Themes/Theme.dart';
import 'package:lanal_akses_mobile/Themes/Typography.dart';

class WelcomeScreen extends StatelessWidget {
  const WelcomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: mainTheme.backgroundColor,
      body: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Image.asset(
            "assets/images/logo_no_bg.png",
            width: MediaQuery.of(context).size.width / 2,
          ),
          Center(
            child: Padding(
              padding: EdgeInsets.only(
                top: 44,
                bottom: 18,
              ),
              child: Text.rich(
                TextSpan(
                  text: 'Lanal '.toUpperCase(),
                  style: mainTitle.copyWith(color: Colors.white),
                  children: <InlineSpan>[
                    TextSpan(
                      text: 'Akses'.toUpperCase(),
                      style: mainTitle.copyWith(
                          color: mainTheme.colorScheme.onSecondary),
                    )
                  ],
                ),
              ),
            ),
          ),
          Container(
            width: 250.0,
            height: 80.0,
            margin: EdgeInsets.only(bottom: 50),
            child: Text(
              'Aplikasi absensi dan data personil Pangkalan Utama Angkatan Laut V Pangkalan TNI AL Banyuwangi',
              style: mainsubHead,
              maxLines: 3,
              textAlign: TextAlign.center,
            ),
          ),
          ElevatedButton(
            onPressed: () {
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) => const QrScanPages()),
              );
            },
            child: Row(
              mainAxisSize: MainAxisSize.min,
              children: [
                Text(
                  "Lanjut",
                  style: mainButtonText,
                  textAlign: TextAlign.center,
                ),
                Iconify(
                  Ep.arrow_right,
                  size: 16,
                  color: Colors.white,
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
