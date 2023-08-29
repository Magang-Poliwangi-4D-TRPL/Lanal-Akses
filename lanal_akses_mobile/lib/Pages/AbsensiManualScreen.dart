import 'package:flutter/material.dart';
import 'package:iconify_flutter/iconify_flutter.dart';
import 'package:iconify_flutter/icons/carbon.dart';
import 'package:iconify_flutter/icons/ep.dart';
import 'package:iconify_flutter/icons/heroicons.dart';
import 'package:iconify_flutter/icons/ic.dart';
import 'package:iconify_flutter/icons/material_symbols.dart';
import 'package:iconify_flutter/icons/mdi.dart';
import 'package:lanal_akses_mobile/Pages/AbsensiSuccessScreen.dart';
import 'package:lanal_akses_mobile/Pages/PerizinanScreen.dart';
import 'package:lanal_akses_mobile/Widgets/customForm.dart';
import '../Themes/Theme.dart';
import '../Themes/Typography.dart';

class AbsensiManualPage extends StatefulWidget {
  const AbsensiManualPage({super.key});

  @override
  State<AbsensiManualPage> createState() => _AbsensiManualPageState();
}

class _AbsensiManualPageState extends State<AbsensiManualPage> {
  final _formAbsensiKey = GlobalKey<FormState>();
  TextEditingController _namaPersonilCont = TextEditingController();
  var _keteranganJaga = 'Hadir';
  TextEditingController _nrpPersonilCont = TextEditingController();

  // List of items in our dropdown menu
  var dropdownItems = [
    'Hadir',
    'Jaga Posal',
    'Cuti',
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBarAbsensiManual(context),
      backgroundColor: Color(0xffE5FFFF),
      body: Container(
        width: double.infinity,
        height: MediaQuery.of(context).size.height,
        padding: EdgeInsets.symmetric(horizontal: 20.0),
        child: ListView(
          children: [
            SizedBox(
              height: MediaQuery.of(context).size.height * 0.1,
            ),
            Text(
              'Absensi Personil',
              style: mainTitle.copyWith(fontSize: 26),
              textAlign: TextAlign.left,
            ),
            SizedBox(
              height: 14,
            ),
            Text(
              'Lakukan absensi dengan nama dan nrp',
              style: mainBody,
              textAlign: TextAlign.left,
            ),
            SizedBox(
              height: 36,
            ),
            Form(
              key: _formAbsensiKey,
              child: Column(
                children: [
                  customForm(
                    context,
                    TextInputType.text,
                    _namaPersonilCont,
                    'nama lengkap',
                    true,
                    Iconify(
                      Ic.baseline_person,
                      size: 28,
                      color: Colors.white,
                    ),
                  ),
                  SizedBox(
                    height: 14.0,
                  ),
                  customForm(
                    context,
                    TextInputType.text,
                    _nrpPersonilCont,
                    'nrp',
                    true,
                    Iconify(
                      Heroicons.identification_solid,
                      size: 28,
                      color: Colors.white,
                    ),
                  ),
                  SizedBox(
                    height: 14.0,
                  ),
                  Container(
                    padding: EdgeInsets.all(8),
                    alignment: Alignment.centerLeft,
                    child: Text(
                      'Tidak wajib diisi (jika personil tidak berada di pangkalan)',
                      style: mainsubHead.copyWith(
                          color: mainTheme.primaryColor, fontSize: 12),
                    ),
                  ),
                  Container(
                    width: MediaQuery.of(context).size.width,
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
                            padding: EdgeInsets.symmetric(
                                horizontal: 18, vertical: 16),
                            child: Iconify(
                              Mdi.file_document,
                              color: Colors.white,
                            )),
                        Container(
                          padding: EdgeInsets.only(
                              right: 14, left: 6, top: 6, bottom: 6),
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
                          child: DropdownButton(
                            isExpanded: true,
                            value: _keteranganJaga,
                            alignment: AlignmentDirectional.centerStart,
                            elevation: 18,
                            style: mainBody.copyWith(
                              fontSize: 18,
                            ),
                            icon: Icon(
                              Icons.keyboard_arrow_down,
                              color: Colors.grey[400],
                            ),
                            items: dropdownItems.map((String items) {
                              return DropdownMenuItem(
                                value: items,
                                child: Text(items),
                              );
                            }).toList(),
                            // After selecting the desired option,it will
                            // change button value to selected value
                            onChanged: (String? newValue) {
                              setState(() {
                                _keteranganJaga = newValue!;
                              });
                            },
                          ),
                        ),
                      ],
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(top: 30),
                    height: 55,
                    child: ElevatedButton(
                      onPressed: () {
                        var postData = [];
                        if (_formAbsensiKey.currentState!.validate()) {
                          setState(() {
                            postData.add(_namaPersonilCont.text);
                            postData.add(_nrpPersonilCont.text);
                          });
                          for (var data in postData) {
                            print(data);
                          }
                          showModalBottomSheet(
                              isScrollControlled: true,
                              context: context,
                              builder: (context) => AbsensiSucces());
                        }
                      },
                      style: ButtonStyle(
                          shape:
                              MaterialStateProperty.all<RoundedRectangleBorder>(
                                  RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12.0),
                      ))),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Text(
                            'Hadir',
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
                  Container(
                    margin: EdgeInsets.only(top: 14),
                    height: 55,
                    child: ElevatedButton(
                      onPressed: () {
                        Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) => const PerizinanPage()));
                      },
                      style: ButtonStyle(
                          backgroundColor:
                              MaterialStateProperty.all(Color(0xFF6D9997)),
                          shape:
                              MaterialStateProperty.all<RoundedRectangleBorder>(
                                  RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12.0),
                          ))),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Text(
                            'Ajukan Perizinan',
                            style: mainButtonText.copyWith(fontSize: 18.0),
                          ),
                          SizedBox(
                            width: 10,
                          ),
                          Iconify(
                            Carbon.document,
                            color: Colors.white,
                          ),
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            ),
            SizedBox(
              height: MediaQuery.of(context).size.height * 0.1,
            ),
          ],
        ),
      ),
    );
  }
}

PreferredSizeWidget AppBarAbsensiManual(BuildContext context) {
  return AppBar(
    title: Text(
      'Absensi Manual',
      style: mainTitle.copyWith(
        color: Colors.white,
        fontSize: 20.0,
      ),
      textAlign: TextAlign.right,
    ),
    leading: IconButton(
      onPressed: () {
        Navigator.pop((context));
      },
      icon: Iconify(
        Ep.arrow_left,
        size: 18.0,
        color: Colors.white,
      ),
    ),
  );
}
