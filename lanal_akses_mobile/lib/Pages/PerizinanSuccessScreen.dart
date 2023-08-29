import 'package:flutter/material.dart';
import 'package:iconify_flutter/iconify_flutter.dart';
import 'package:iconify_flutter/icons/material_symbols.dart';
import 'package:lanal_akses_mobile/Themes/Theme.dart';
import 'package:lanal_akses_mobile/Themes/Typography.dart';

class PerizinanSuccess extends StatelessWidget {
  const PerizinanSuccess({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: mainTheme.primaryColor,
      body: ListView(
        children: [
          SizedBox(
            height: 54,
          ),
          Container(
            padding: EdgeInsets.all(10),
            child: Text(
              'Selamat'.toUpperCase(),
              style: mainTitle.copyWith(color: Colors.white),
              textAlign: TextAlign.center,
            ),
          ),
          Container(
            padding: EdgeInsets.all(10),
            child: Text(
              'Perizinan anda sudah dikirim',
              style: mainsubHead.copyWith(color: Colors.white),
              textAlign: TextAlign.center,
            ),
          ),
          SizedBox(
            height: 54,
          ),
          Image.asset('assets/images/image_perizinan_success.png'),
          SizedBox(
            height: 54,
          ),
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 16.0),
            child: Container(
              margin: EdgeInsets.only(top: 30),
              height: 55,
              child: ElevatedButton(
                onPressed: () {
                  Navigator.pop(context);
                },
                style: ButtonStyle(
                    shape: MaterialStateProperty.all<RoundedRectangleBorder>(
                      RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12.0),
                      ),
                    ),
                    backgroundColor: MaterialStateColor.resolveWith(
                        (states) => Color(0xff263238))),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      'Selesai',
                      style: mainButtonText.copyWith(fontSize: 18.0),
                    ),
                    SizedBox(
                      width: 10,
                    ),
                    Iconify(
                      MaterialSymbols.done,
                      color: Colors.white,
                    )
                  ],
                ),
              ),
            ),
          ),
          SizedBox(
            height: 54,
          ),
        ],
      ),
    );
  }
}
