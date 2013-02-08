<?php
/**
 * This file is part of OPUS. The software OPUS has been originally developed
 * at the University of Stuttgart with funding from the German Research Net,
 * the Federal Department of Higher Education and Research and the Ministry
 * of Science, Research and the Arts of the State of Baden-Wuerttemberg.
 *
 * OPUS 4 is a complete rewrite of the original OPUS software and was developed
 * by the Stuttgart University Library, the Library Service Center
 * Baden-Wuerttemberg, the Cooperative Library Network Berlin-Brandenburg,
 * the Saarland University and State Library, the Saxon State Library -
 * Dresden State and University Library, the Bielefeld University Library and
 * the University Library of Hamburg University of Technology with funding from
 * the German Research Foundation and the European Regional Development Fund.
 *
 * LICENCE
 * OPUS is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the Licence, or any later version.
 * OPUS is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details. You should have received a copy of the GNU General Public License
 * along with OPUS; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
 * @category    TODO
 * @package     TODO
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class Opusvier2734Test extends TestCase {

    private function goToSecondStep($value) {
        $this->switchToGerman();
        $this->openAndWait('/publish');
        $this->select('documentType', "value=$value");
        $this->click('rights');
        $this->click('send');
        $this->waitForPageToLoad();                
    }

    private function goToSecondStepForDoctypeAll() {
        $this->goToSecondStep('all');
        $this->click('LegalNotices');
    }

    private function goToSecondStepForDoctypeMatheon() {
        $this->goToSecondStep('preprintmatheon');
    }

    private function goToThirdStep() {
        $this->click("send");
        $this->waitForPageToLoad();
    }

    private function goBackToSecondStep() {
        $this->click("back");
        $this->waitForPageToLoad();
    }

    public function testAddAndDeleteButton() {
        $this->goToSecondStepForDoctypeAll();
        
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->type('PersonAuthorFirstName_1', 'PAFN1');
        $this->type('PersonAuthorLastName_1', 'PALN1');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->goBackToSecondStep();
        
        $this->click('addMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementPresent('PersonAuthorFirstName_2');
        $this->type('PersonAuthorFirstName_2', 'PAFN2');
        $this->type('PersonAuthorLastName_2', 'PALN2');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextPresent('PAFN2');
        $this->assertTextPresent('PALN2');
        $this->goBackToSecondStep();

        $this->click('addMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementPresent('PersonAuthorFirstName_2');
        $this->assertElementPresent('PersonAuthorFirstName_3');
        $this->type('PersonAuthorFirstName_3', 'PAFN3');
        $this->type('PersonAuthorLastName_3', 'PALN3');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextPresent('PAFN2');
        $this->assertTextPresent('PALN2');
        $this->assertTextPresent('PAFN3');
        $this->assertTextPresent('PALN3');
        $this->goBackToSecondStep();

        $this->click('deleteMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementPresent('PersonAuthorFirstName_2');
        $this->assertElementNotPresent('PersonAuthorFirstName_3');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextPresent('PAFN2');
        $this->assertTextPresent('PALN2');
        $this->assertTextNotPresent('PAFN3');
        $this->assertTextNotPresent('PALN3');
        $this->goBackToSecondStep();

        $this->click('deleteMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementNotPresent('PersonAuthorFirstName_2');
        $this->assertElementNotPresent('PersonAuthorFirstName_3');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextNotPresent('PAFN2');
        $this->assertTextNotPresent('PALN2');
        $this->assertTextNotPresent('PAFN3');
        $this->assertTextNotPresent('PALN3');
        $this->goBackToSecondStep();
        
        $this->click('addMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementPresent('PersonAuthorFirstName_2');
        $this->assertElementNotPresent('PersonAuthorFirstName_3');
        $this->type('PersonAuthorFirstName_2', 'PAFN4');
        $this->type('PersonAuthorLastName_2', 'PALN4');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextNotPresent('PAFN2');
        $this->assertTextNotPresent('PALN2');
        $this->assertTextNotPresent('PAFN3');
        $this->assertTextNotPresent('PALN3');
        $this->assertTextPresent('PAFN4');
        $this->assertTextPresent('PALN4');
        $this->goBackToSecondStep();

        $this->click('deleteMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent('PersonAuthorFirstName_1'));
        $this->assertFalse($this->isElementPresent('PersonAuthorFirstName_2'));
        $this->assertFalse($this->isElementPresent('PersonAuthorFirstName_3'));

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextNotPresent('PAFN2');
        $this->assertTextNotPresent('PALN2');
        $this->assertTextNotPresent('PAFN3');
        $this->assertTextNotPresent('PALN3');
        $this->assertTextNotPresent('PAFN4');
        $this->assertTextNotPresent('PALN4');
        $this->goBackToSecondStep();

        $this->click('abort');
    }

    public function testBrowseUpAndDownButton() {
        $this->goToSecondStepForDoctypeAll();

        $this->select('SubjectMSC_1', 'value=7653');                

        $this->goToThirdStep();
        $this->assertTextPresent('00-XX GENERAL');
        $this->goBackToSecondStep();

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->select('collId2SubjectMSC_1', 'value=7655');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->goBackToSecondStep();

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->goBackToSecondStep();

        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();
        
        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->goBackToSecondStep();

        $this->select('SubjectMSC_2', 'value=7871');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->goBackToSecondStep();

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->select('collId2SubjectMSC_2', 'value=7873');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();
      
        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->select('SubjectMSC_4', 'value=7871');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->select('SubjectMSC_5', 'value=7727');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->goBackToSecondStep();

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextNotPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextNotPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextNotPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextNotPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->select('collId2SubjectMSC_2', 'value=7878');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->goBackToSecondStep();

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();
        
        $this->select('collId3SubjectMSC_2', 'value=7880');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();        

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->select('SubjectMSC_2', 'label=Bitte wählen Sie eine MSC Klasse');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->select('SubjectMSC_1', 'label=Bitte wählen Sie eine MSC Klasse');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('abort');
    }

}

?>
