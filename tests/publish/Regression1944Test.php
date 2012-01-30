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
 * @category    Application
 * @package     Module_Publish
 * @package     Module_Publish Selenium Test MATHEON
 * @author      Susanne Gottwald <gottwald@zib.de>
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class Regression1944Test extends TestCase {

    public function testImpossibleCollectionChange() {
        $this->open("/opus4-selenium");
        $this->waitForPageToLoad();
        $this->open("/opus4-selenium/home/index/language/language/de");
        $this->waitForPageToLoad();
        $this->open("/opus4-selenium/publish");
        $this->click("//li[@id='primary-nav-publish']/a/em/span");
        $this->waitForPageToLoad();
        $this->select("id=documentType", "label=Preprint für MATHEON");
        $this->click("id=rights");
        $this->click("id=send");
        $this->waitForPageToLoad();

        $this->type("id=PersonAuthorFirstName1", "tester");
        $this->type("id=PersonAuthorLastName1", "test");
        $this->type("id=TitleMain1", "Entenhausen");
        $this->type("id=TitleAbstract1", "drltk-jzrkld5zhjkls");
        $this->select("id=Institute1", "label=Technische Universität Hamburg-Harburg");
        $this->click("id=browseDownInstitute");
        $this->waitForPageToLoad();
        $this->click("id=browseDownInstitute");
        $this->waitForPageToLoad();
        $this->select("id=SubjectMSC1", "label=03-XX MATHEMATICAL LOGIC AND FOUNDATIONS");
        $this->click("id=browseDownSubjectMSC");
        $this->waitForPageToLoad();
        $this->verifyTextPresent("03-00 General reference works (handbooks, dictionaries, bibliographies, etc.) 03-01 Instructional exposition (textbooks, tutorial papers, etc.) 03-02 Research exposition (monographs, survey articles) 03-03 Historical (must also be assigned at least one classification number from Section 01) 03-04 Explicit machine computation and programs (not the theory of computation or programming) 03-06 Proceedings, conferences, collections, etc. 03Axx Philosophical aspects of logic and foundations 03Bxx General logic 03Cxx Model theory 03Dxx Computability and recursion theory 03Exx Set theory 03Fxx Proof theory and constructive mathematics 03Gxx Algebraic logic 03Hxx Nonstandard models [See also 03C62]");
        $this->click("id=browseUpSubjectMSC");
        $this->waitForPageToLoad();
        $this->select("id=SubjectMSC1", "label=22-XX TOPOLOGICAL GROUPS, LIE GROUPS (For transformation groups, see 54H15, 57Sxx, 58-XX. For abstract harmonic analysis, see 43-XX)");
        $this->click("id=browseDownSubjectMSC");
        $this->waitForPageToLoad();
        $this->verifyTextPresent("22-00 General reference works (handbooks, dictionaries, bibliographies, etc.) 22-01 Instructional exposition (textbooks, tutorial papers, etc.) 22-02 Research exposition (monographs, survey articles) 22-03 Historical (must also be assigned at least one classification number from Section 01) 22-04 Explicit machine computation and programs (not the theory of computation or programming) 22-06 Proceedings, conferences, collections, etc. 22Axx Topological and differentiable algebraic systems (For topological rings and fields, see 12Jxx, 13Jxx, 16W80) 22Bxx Locally compact abelian groups (LCA groups) 22Cxx Compact groups 22Dxx Locally compact groups and their algebras 22Exx Lie groups (For the topology of Lie groups and homogeneous spaces, see 57Sxx, 57Txx; for analysis thereon, see 43A80, 43A85, 43A90) 22Fxx Noncompact transformation groups");
        $this->click("id=send");
        $this->waitForPageToLoad();
    }

}

?>