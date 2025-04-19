import { formatNumber, customDateFormatter } from '../Utilities/utilFunctions';
const generateApplicantTableRow = (item: any) => {
    return [
        /*html*/ `${
            (item?.prefix ?? '') +
            ' ' +
            item.f_name +
            ' ' +
            (item?.mid_name ?? '') +
            ' ' +
            item.l_name +
            ' ' +
            (item?.suffix ?? '')
        }
            <input
                type="hidden"
                name="sex"
                value="${item.sex}"
            />
            <input
                type="hidden"
                name="birth_date"
                value="${item.birth_date}"
            />
            <input
                type="hidden"
                name="applicant_home_address"
                value="${item.landmark || ''}, ${item.barangay || ''}, ${item.city || ''}, ${item.province || ''}, ${item.region || ''}, ${item.zip_code || ''}"
            />`,
        `${item.designation}`,
        /*html*/ `<div>
            <strong>Firm Name:</strong>
            <span class="firm_name">${item.firm_name}</span
            ><br />
            <strong>Business Address:</strong>
            <br>
            <input type="hidden" name="sectors" value="${item.sectors}" />
            <input
                type="hidden"
                name="userID"
                value="${item.user_id}"
            />
            <input
                type="hidden"
                name="applicationID"
                value="${item.Application_ID}"
            />
            <input
                type="hidden"
                name="businessID"
                value="${item.business_id}"
            />
            <input
                type="hidden"
                name="male_direct_re"
                value="${item.male_direct_re || '0'}"
            />
            <input
                type="hidden"
                name="female_direct_re"
                value="${item.female_direct_re || '0'}"
            />
            <input
                type="hidden"
                name="male_direct_part"
                value="${item.male_direct_part || '0'}"
            />
            <input
                type="hidden"
                name="female_direct_part"
                value="${item.female_direct_part || '0'}"
            />
            <input
                type="hidden"
                name="male_indirect_re"
                value="${item.male_indirect_re || '0'}"
            />
            <input
                type="hidden"
                name="female_indirect_re"
                value="${item.female_indirect_re || '0'}"
            />
            <input
                type="hidden"
                name="male_indirect_part"
                value="${item.male_indirect_part || '0'}"
            />
            <input
                type="hidden"
                name="female_indirect_part"
                value="${item.female_indirect_part || '0'}"
            />
            <input
                type="hidden"
                name="total_personnel"
                value="${
                    parseInt(item.male_direct_re || 0) +
                    parseInt(item.female_direct_re || 0) +
                    parseInt(item.male_direct_part || 0) +
                    parseInt(item.female_direct_part || 0) +
                    parseInt(item.male_indirect_re || 0) +
                    parseInt(item.female_indirect_re || 0) +
                    parseInt(item.male_indirect_part || 0) +
                    parseInt(item.female_indirect_part || 0)
                }"
            />
            <strong class="ps-2"> Office Address:</strong>
            <span class="business_address text-truncate ps-3"
                >${item.office_landmark || ''}, ${item.office_barangay || ''},
                ${item.office_city || ''}, ${item.office_province || ''},
                ${item.office_region || ''}</span
            ><br />
            <strong class="ps-2">Factory Address:</strong>
            <span class="factory_address text-truncate ps-3"
                >${item.factory_landmark || ''}, ${item.factory_barangay || ''},
                ${item.factory_city || ''}, ${item.factory_province || ''},
                ${item.factory_region || ''}</span
            ><br />
            <strong>Type of Enterprise:</strong>
            <span class="enterprise_l"
                >${item.enterprise_type}</span
            >
            <p>
                <strong>Assets:</strong> <br />
                <span class="ps-2 asset-building"
                    >Building:
                    ${formatNumber(parseFloat(item.building_value))}</span
                ><br />
                <span class="ps-2 asset-equipment"
                    >Equipment:
                    ${formatNumber(parseFloat(item.equipment_value))}</span
                >
                <br />
                <span class="ps-2 asset-working-capital"
                    >Working Capital:
                    ${formatNumber(parseFloat(item.working_capital))}</span
                >
            </p>
            <strong>Contact Details:</strong>
            <p>
                <strong class="p-2">Landline:</strong>
                <span class="landline"
                    >${item.landline}</span
                >
                <br />
                <strong class="p-2">Mobile Phone:</strong>
                <span class="mobile_num"
                    >${item.mobile_number}</span
                >
                <br />
                <strong class="p-2">Email:</strong>
                <span class="email_add">${item.email}</span>
            </p>
        </div>`,
        `${customDateFormatter(item.date_applied)}`,
        /*html*/ `<span
            class="badge ${
                item.application_status === 'new'
                    ? 'bg-primary'
                    : item.application_status === 'evaluation'
                      ? 'bg-info'
                      : item.application_status === 'pending'
                        ? 'bg-primary'
                        : 'bg-danger'
            }"
            >${item.application_status}</span
        ><input
            type="hidden"
            name="requested_fund_amount"
            value="${item.requested_fund_amount}"
        />`,
        /*html*/ ` <button
            class="btn btn-primary applicantDetailsBtn"
            data-applicant-id="${item.Application_ID}"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#applicantDetails"
            aria-controls="applicantDetails"
        >
            <i class="ri-menu-unfold-4-line ri-1x"></i>
        </button>`,
    ];
};

const extractApplicantDetailedInfo = (row: JQuery<HTMLElement>) => {
    const birthDate = row.find('input[name="birth_date"]').val() as string;
    const CONTACT_PERSON_INFO = {
        fullName: row.find('td:nth-child(1)').text().trim(),
        sex: row.find("input[name='sex']").val(),
        age: (
            new Date().getFullYear() - new Date(birthDate).getFullYear()
        ).toString(),
        homeAddress: row.find('input[name="applicant_home_address"]').val(),
        designation: row.find('td:nth-child(2)').text().trim(),
        contactNumber: row.find('span.mobile_num').text().trim(),
        landline: row.find('span.landline').text().trim(),
        email: row.find('span.email_add').text().trim(),
        requestedFundAmount: row
            .find('input[name="requested_fund_amount"]')
            .val(),
    };

    const BUSINESS_INFO = {
        firmName: row.find('span.firm_name').text().trim(),
        sectors: row.find('input[name="sectors"]').val(),
        officeAddress: row.find('span.business_address').text().trim(),
        factoryAddress: row.find('span.factory_address').text().trim(),
        enterpriseType: row.find('span.enterprise_l').text().trim(),
        buildingAsset: row
            .find('span.asset-building')
            .text()
            .replace('Building:', '')
            .trim(),
        equipmentAsset: row
            .find('span.asset-equipment')
            .text()
            .replace('Equipment:', '')
            .trim(),
        workingCapitalAsset: row
            .find('span.asset-working-capital')
            .text()
            .replace('Working Capital:', '')
            .trim(),
    };
    const userID = row.find('input[name="userID"]').val();
    const ApplicationID = row.find('input[name="applicationID"]').val();
    const businessID = row.find('input[name="businessID"]').val();
    const personnel = {
        male_direct_re: row.find('input[name="male_direct_re"]').val(),
        female_direct_re: row.find('input[name="female_direct_re"]').val(),
        male_direct_part: row.find('input[name="male_direct_part"]').val(),
        female_direct_part: row.find('input[name="female_direct_part"]').val(),
        male_indirect_re: row.find('input[name="male_indirect_re"]').val(),
        female_indirect_re: row.find('input[name="female_indirect_re"]').val(),
        male_indirect_part: row.find('input[name="male_indirect_part"]').val(),
        female_indirect_part: row
            .find('input[name="female_indirect_part"]')
            .val(),
        total_personnel: row.find('input[name="total_personnel"]').val(),
    };

    return {
        CONTACT_PERSON_INFO,
        BUSINESS_INFO,
        userID,
        ApplicationID,
        businessID,
        personnel,
    };
};

const populateApplicantDetails = (
    ApplicantDetailsContainer: JQuery<HTMLElement>,
    CONTACT_PERSON_INFO: any,
    BUSINESS_INFO: any,
    userID: string,
    ApplicationID: string,
    businessID: string,
    personnel: any
) => {
    const ApplicantDetails = ApplicantDetailsContainer.find(
        '#applicantDetails input'
    );
    ApplicantDetails.filter('#contact_person').val(
        CONTACT_PERSON_INFO.fullName
    );
    ApplicantDetails.filter('#age').val(CONTACT_PERSON_INFO.age);
    ApplicantDetails.filter('#designation').val(
        CONTACT_PERSON_INFO.designation
    );
    ApplicantDetails.filter('#sex').val(CONTACT_PERSON_INFO.sex);
    ApplicantDetails.filter('#landline').val(CONTACT_PERSON_INFO.landline);
    ApplicantDetails.filter('#mobile_phone').val(
        CONTACT_PERSON_INFO.contactNumber
    );
    ApplicantDetails.filter('#email').val(CONTACT_PERSON_INFO.email);
    ApplicantDetails.filter('#requested_fund_amount').val(
        formatNumber(parseFloat(CONTACT_PERSON_INFO.requestedFundAmount ?? 0))
    );

    ApplicantDetails.filter('#firm_name').val(BUSINESS_INFO.firmName);
    ApplicantDetails.filter('#selected_userId').val(userID);
    ApplicantDetails.filter('#selected_businessID').val(businessID);
    ApplicantDetails.filter('#selected_applicationId').val(ApplicationID);
    ApplicantDetails.filter('#contactPersonHomeAddress').val(
        CONTACT_PERSON_INFO.homeAddress.replace(/\s+/g, ' ').trim()
    );
    ApplicantDetails.filter('#factoryAddress').val(
        BUSINESS_INFO.factoryAddress.replace(/\s+/g, ' ').trim()
    );
    ApplicantDetails.filter('#officeAddress').val(
        BUSINESS_INFO.officeAddress.replace(/\s+/g, ' ').trim()
    );
    ApplicantDetails.filter('#building').val(BUSINESS_INFO.buildingAsset);
    ApplicantDetails.filter('#equipment').val(BUSINESS_INFO.equipmentAsset);
    ApplicantDetails.filter('#working_capital').val(
        BUSINESS_INFO.workingCapitalAsset
    );
    ApplicantDetails.filter('#enterpriseType').val(
        BUSINESS_INFO.enterpriseType
    );
    ApplicantDetails.filter('#enterpriseSector').val(BUSINESS_INFO.sectors);
    ApplicantDetails.filter('#male_direct_re').val(
        personnel.male_direct_re || '0'
    );
    ApplicantDetails.filter('#female_direct_re').val(
        personnel.female_direct_re || '0'
    );
    ApplicantDetails.filter('#male_direct_part').val(
        personnel.male_direct_part || '0'
    );
    ApplicantDetails.filter('#female_direct_part').val(
        personnel.female_direct_part || '0'
    );
    ApplicantDetails.filter('#male_indirect_re').val(
        personnel.male_indirect_re || '0'
    );
    ApplicantDetails.filter('#female_indirect_re').val(
        personnel.female_indirect_re || '0'
    );
    ApplicantDetails.filter('#male_indirect_part').val(
        personnel.male_indirect_part || '0'
    );
    ApplicantDetails.filter('#female_indirect_part').val(
        personnel.female_indirect_part || '0'
    );
    ApplicantDetails.filter('#total_personnel').val(
        personnel.total_personnel || '0'
    );
};

export {
    generateApplicantTableRow,
    extractApplicantDetailedInfo,
    populateApplicantDetails,
};
