import 'package:flutter/material.dart';
import 'package:lanal_akses_mobile/Themes/Theme.dart';

import '../Themes/Typography.dart';

Widget customForm(
    BuildContext context,
    TextInputType? keyboardType,
    TextEditingController? controller,
    String? hintText,
    bool? enableForm,
    Widget? icon) {
  return Container(
    width: MediaQuery.of(context).size.width - 8,
    child: Row(
      children: [
        Container(
            decoration: BoxDecoration(
              color: mainTheme.primaryColor,
              borderRadius: BorderRadius.only(
                topLeft: Radius.circular(16.0),
                bottomLeft: Radius.circular(16.0),
              ),
              boxShadow: [
                BoxShadow(
                  blurRadius: 5,
                  color: Colors.grey.shade400,
                  offset: Offset(-2, 4),
                )
              ],
            ),
            padding: EdgeInsets.symmetric(horizontal: 18, vertical: 16),
            child: icon),
        Expanded(
          child: Container(
              padding: EdgeInsets.only(right: 14, left: 6, top: 6, bottom: 6),
              width: MediaQuery.of(context).size.width * 0.75,
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.only(
                  topRight: Radius.circular(16.0),
                  bottomRight: Radius.circular(16.0),
                ),
                boxShadow: [
                  BoxShadow(
                    blurRadius: 5,
                    color: Colors.grey.shade400,
                    offset: Offset(2, 4),
                  )
                ],
              ),
              child: TextFormField(
                enabled: enableForm,
                autofocus: false,
                obscureText: false,
                onSaved: (val) => controller,
                validator: (val) {
                  if (val == null || val.isEmpty) {}
                  return null;
                },
                controller: controller,
                scrollPadding: EdgeInsets.all(10.0),
                maxLines: 1,
                cursorHeight: 24,
                keyboardType: keyboardType,
                style: mainBody.copyWith(fontSize: 20),
                decoration: InputDecoration(
                  hintText: 'Masukkan ${hintText} anda',
                  hintStyle: mainBody.copyWith(
                    color: Colors.grey[400],
                    fontSize: 18,
                  ),
                  focusedBorder: UnderlineInputBorder(
                    borderSide: BorderSide(
                        width: 1, color: mainTheme.colorScheme.onPrimary),
                  ),
                ),
              )),
        ),
      ],
    ),
  );
}
