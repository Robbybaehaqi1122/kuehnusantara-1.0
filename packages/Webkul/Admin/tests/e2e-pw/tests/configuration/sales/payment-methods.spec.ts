import { test, expect } from "../../../setup";
import {
    generateEmail,
    generateDescription,
    generateCurrency,
    getImageFile,
} from "../../../utils/faker";

test.describe("payment methods configuration", () => {
    /**
     * Navigate to the configuration page.
     */
    test.beforeEach(async ({ adminPage }) => {
        await adminPage.goto("admin/configuration/sales/payment_methods");
    });

    /**
     * Update the Cash On Delivery Payment Method Configuration.
     */
    test("should configure the cash on delivery payment method", async ({
        adminPage,
    }) => {
        await adminPage.fill(
            'textarea[name="sales[payment_methods][cashondelivery][description]"]',
            generateDescription(200)
        );

        const [fileChooser] = await Promise.all([
            adminPage.waitForEvent("filechooser"),
            adminPage.click('label:has-text("Logo")'),
        ]);

        await fileChooser.setFiles(getImageFile());

        await adminPage.fill(
            'textarea[name="sales[payment_methods][cashondelivery][instructions]"]',
            generateDescription(200)
        );

        await adminPage.click(
            'label[for="sales[payment_methods][cashondelivery][generate_invoice]"]'
        );
        // const generateInvoiceToggle = await adminPage.locator('input[name="sales[payment_methods][cashondelivery][generate_invoice]"]');
        // await expect(generateInvoiceToggle).toBeChecked();

        // if (await generateInvoiceToggle.toBeChecked()) {
        await adminPage.selectOption(
            'select[name="sales[payment_methods][cashondelivery][invoice_status]"]',
            "pending"
        );
        const invoiceStatus = adminPage.locator(
            'select[name="sales[payment_methods][cashondelivery][invoice_status]"]'
        );
        await expect(invoiceStatus).toHaveValue("pending");
        // }

        await adminPage.selectOption(
            'select[name="sales[payment_methods][cashondelivery][order_status]"]',
            "pending"
        );
        const orderStatus = adminPage.locator(
            'select[name="sales[payment_methods][cashondelivery][order_status]"]'
        );
        await expect(orderStatus).toHaveValue("pending");

        // await adminPage.click(
        //     'label[for="sales[payment_methods][cashondelivery][active]"]'
        // );
        // const cashondeliveryToggle = await adminPage.locator('input[name="sales[payment_methods][cashondelivery][active]"]');
        // await expect(cashondeliveryToggle).toBeChecked();

        // if (await cashondeliveryToggle.toBeChecked()) {
        //     await adminPage.fill('input[name="sales[payment_methods][cashondelivery][title]"]', generateName());
        // }

        await adminPage.selectOption(
            'select[name="sales[payment_methods][cashondelivery][sort]"]',
            "2"
        );
        const sort = adminPage.locator(
            'select[name="sales[payment_methods][cashondelivery][sort]"]'
        );
        await expect(sort).toHaveValue("2");

        await adminPage.click('button[type="submit"].primary-button:visible');

        /**
         * Verify the change is saved.
         */
        await expect(
            adminPage.getByText("Configuration saved successfully")
        ).toBeVisible();
    });

    /**
     * Update the Money Transfer Payment Method Configuration.
     */
    test("should configure the money transfer payment method", async ({
        adminPage,
    }) => {
        await adminPage.fill(
            'textarea[name="sales[payment_methods][moneytransfer][description]"]',
            generateDescription(200)
        );

        const [fileChooser] = await Promise.all([
            adminPage.waitForEvent("filechooser"),
            adminPage.click('label:has-text("Logo")'),
        ]);

        await fileChooser.setFiles(getImageFile());

        await adminPage.click(
            'label[for="sales[payment_methods][moneytransfer][generate_invoice]"]'
        );
        // const generateInvoiceToggle = await adminPage.locator('input[name="sales[payment_methods][moneytransfer][generate_invoice]"]');
        // await expect(generateInvoiceToggle).toBeChecked();

        // if (await generateInvoiceToggle.toBeChecked()) {
        await adminPage.selectOption(
            'select[name="sales[payment_methods][moneytransfer][invoice_status]"]',
            "pending"
        );
        const invoiceStatus = adminPage.locator(
            'select[name="sales[payment_methods][moneytransfer][invoice_status]"]'
        );
        await expect(invoiceStatus).toHaveValue("pending");
        // }

        await adminPage.selectOption(
            'select[name="sales[payment_methods][moneytransfer][order_status]"]',
            "pending"
        );
        const orderStatus = adminPage.locator(
            'select[name="sales[payment_methods][moneytransfer][order_status]"]'
        );
        await expect(orderStatus).toHaveValue("pending");

        await adminPage.fill(
            'textarea[name="sales[payment_methods][moneytransfer][mailing_address]"]',
            generateDescription(200)
        );

        // await adminPage.click(
        //     'label[for="sales[payment_methods][moneytransfer][active]"]'
        // );
        // const moneyTransferToggle = await adminPage.locator('input[name="sales[payment_methods][moneytransfer][active]"]');
        // await expect(moneyTransferToggle).toBeChecked();

        // if (await moneyTransferToggle.toBeChecked()) {
        //     await adminPage.fill('input[name="sales[payment_methods][moneytransfer][title]"]', generateName());
        // }

        await adminPage.selectOption(
            'select[name="sales[payment_methods][moneytransfer][sort]"]',
            "2"
        );
        const sort = adminPage.locator(
            'select[name="sales[payment_methods][moneytransfer][sort]"]'
        );
        await expect(sort).toHaveValue("2");

        await adminPage.click('button[type="submit"].primary-button:visible');

        /**
         * Verify the change is saved.
         */
        await expect(
            adminPage.getByText("Configuration saved successfully")
        ).toBeVisible();
    });

});
